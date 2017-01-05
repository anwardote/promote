<?php

namespace LaravelAcl\Authentication\Controllers;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Array_;
use view,
    App;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use LaravelAcl\Authentication\Exceptions\PermissionException;
use LaravelAcl\Authentication\Exceptions\ProfileNotFoundException;
use LaravelAcl\Authentication\Helpers\DbHelper;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserPresenter;
use LaravelAcl\Authentication\Services\UserProfileService;
use LaravelAcl\Authentication\Validators\UserProfileAvatarValidator;
use LaravelAcl\Library\Exceptions\NotFoundException;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Helpers\FormHelper;
use LaravelAcl\Authentication\Exceptions\UserNotFoundException;
use LaravelAcl\Authentication\Validators\UserValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Validators\UserProfileValidator;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use App\Http\Models\CmsPage;
use App\Http\Models\CmsPost;
use App\Http\Models\CmsCategory;
use App\Repositories\CmsPageRepository;
use App\Http\Models\RechargeType;
use App\Repositories\TutorialRepository;
use App\Repositories\DriverNameRepository;
use App\Repositories\ToolRepository;

use App\Http\Models\Firmware;
use App\Http\Models\Driver;
use App\Http\Models\Tool;
use App\Http\Models\Tutorial;
use App\Http\Models\ViewCategory;


class CMSViewController extends Controller
{

    protected $auth;
    protected $cmsPageRepository;
    protected $tutorialRespository;
    protected $toolRepository;


    public function __construct(CmsPageRepository $CmsPageRepo, TutorialRepository $tutorialRepo, ToolRepository $toolRepo)
    {
        $this->cmsPageRepository = $CmsPageRepo;
        $this->tutorialRespository = $tutorialRepo;
        $this->toolRepository =$toolRepo;
    }

    public function getHomePage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('home');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 6], ['status', 'PUBLISHED']])->get();
        }
        $home = CmsPost::where([['cms_category_id', 1], ['status', 'PUBLISHED']])->get();
        return View::make('admin.pages.page')->with(['sliders' => $sliders, 'page' => $page, 'home_rows' => $home]);
    }



    public function getHowtorechargePage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('tool');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 10], ['status', 'PUBLISHED']])->get();
        }
        $cms_Post = CmsPost::where([['cms_category_id', 10], ['status', 'PUBLISHED']])->get();
        $rechargeType = RechargeType::get();

        return View::make('admin.pages.howtorecharge')->with(['sliders' => $sliders, 'page' => $page, 'cms_post' => $cms_Post, 'rechargeType' => $rechargeType]);
    }

    public function getFirmwarePage()
    {

        $page = $this->cmsPageRepository->findBySlugOrId('firmware');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 7], ['status', 'PUBLISHED']])->get();
        }
        $cms_Post = CmsPost::where([['cms_category_id', 2], ['status', 'PUBLISHED']])->get();
        $android = ViewCategory::where('fcategory_id', 1)->take(11)->orderBy('created_at', 'desc')->get();
        $normal = ViewCategory::where('fcategory_id', 2)->take(11)->orderBy('created_at', 'desc')->get();

        $androidShowAll = '';
        $normalShowAll = '';
        if (count($android) > 10) {
            $androidShowAll = true;
            unset($android[11]);
        }
        if (count($normal) > 10) {
            $normalShowAll = true;
            unset($normal[11]);
        }
        return View::make('admin.pages.firmware')->with(['sliders' => $sliders, 'page' => $page, 'cms_post' => $cms_Post, 'android' => $android, 'normal' => $normal, 'androidShowAll' => $androidShowAll, 'normalShowAll' => $normalShowAll]);
    }


    public function getTutorialPage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('tutorial');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 8], ['status', 'PUBLISHED']])->get();
        }
        $cms_Post = CmsPost::where([['cms_category_id', 8], ['status', 'PUBLISHED']])->get();
        $tutorial = Tutorial::take(21)->orderBy('created_at', 'desc')->first()->get();

        $ShowAll = '';
        if (count($tutorial) > 20) {
            $ShowAll = true;
            unset($tutorial[21]);
        }
        return View::make('admin.pages.tutorial')->with(['sliders' => $sliders, 'page' => $page, 'cms_post' => $cms_Post, 'tutorial' => $tutorial, 'showall' => $ShowAll]);
    }

    public function getTutorialCategoryView(Request $request)
    {
        $results = $this->tutorialRespository->all($request->except(['page']), $request);
        return View::make('admin.pages.tutorial-categoryview')->with(['results' => $results, 'request' => $request]);
    }



    public function getDriverPage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('driver');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 9], ['status', 'PUBLISHED']])->get();
        }
        $cms_Post = CmsPost::where([['cms_category_id', 9], ['status', 'PUBLISHED']])->get();
        $driverCategory = ViewCategory::where('fcategory_id', 3)->take(21)->orderBy('created_at', 'desc')->get();
        $ShowAll = '';
        if (count($driverCategory) > 20) {
            $ShowAll = true;
            unset($driverCategory[21]);
        }

        return View::make('admin.pages.driver')->with(['sliders' => $sliders, 'page' => $page, 'cms_post' => $cms_Post, 'viwCategory' => $driverCategory, 'showall' => $ShowAll]);
    }

    public function getToolPage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('tool');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 10], ['status', 'PUBLISHED']])->get();
        }
        $cms_Post = CmsPost::where([['cms_category_id', 10], ['status', 'PUBLISHED']])->get();
        $toolCategory = Tool::take(21)->orderBy('created_at', 'desc')->first()->get();
        $ShowAll = '';
        if (count($toolCategory) > 20) {
            $ShowAll = true;
            unset($toolCategory[21]);
        }
        return View::make('admin.pages.tool')->with(['sliders' => $sliders, 'page' => $page, 'cms_post' => $cms_Post, 'viwCategory' => $toolCategory, 'showall' => $ShowAll]);
    }
    public function getToolCategoryView(Request $request)
    {
        $results = $this->toolRepository->all($request->except(['page']), $request);
        return View::make('admin.pages.tool-categoryview')->with(['results' => $results, 'request' => $request]);
    }





}
