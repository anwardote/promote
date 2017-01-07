<?php

namespace LaravelAcl\Authentication\Controllers;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Array_;
use view,
    App,
    Config;
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
use App\Repositories\CmsPostRepository;
use App\Http\Models\RechargeType;

class CMSViewController extends Controller
{

    protected $auth;
    protected $cmsPageRepository;



    public function __construct(CmsPageRepository $CmsPageRepo)
    {
        $this->cmsPageRepository = $CmsPageRepo;
    }

    public function getHomePage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('home');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 5], ['status', 'PUBLISHED']])->get();
        }
        $home = CmsPost::where([['cms_category_id', 1], ['status', 'PUBLISHED']])->get();
        return View::make('admin.pages.page')->with(['sliders' => $sliders, 'page' => $page, 'home_rows' => $home, 'dynamic_var' => $this->set_variable()]);
    }

    public function getHowtousePage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('how_to_use');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 6], ['status', 'PUBLISHED']])->get();
        }
        $home = CmsPost::where([['cms_category_id', 2], ['status', 'PUBLISHED']])->get();
        return View::make('admin.pages.howtouse')->with(['sliders' => $sliders, 'page' => $page, 'home_rows' => $home, 'dynamic_var' => $this->set_variable()]);
    }


    public function getHowtorechargePage()
    {
        $page = $this->cmsPageRepository->findBySlugOrId('how_to_recharge');
        $sliders = '';
        if ($page->banner_type == 'slider') {
            $sliders = CmsPost::where([['cms_category_id', 7], ['status', 'PUBLISHED']])->get();
        }
        $cms_Post = CmsPost::where([['cms_category_id', 6], ['status', 'PUBLISHED']])->get();
        $rechargeType = RechargeType::get();

        return View::make('admin.pages.howtorecharge')->with(['sliders' => $sliders, 'page' => $page, 'cms_post' => $cms_Post, 'rechargeType' => $rechargeType, 'dynamic_var' => $this->set_variable()]);
    }

    public function getContactUsPage()
    {
        $home = CmsPost::where([['cms_category_id', 4], ['status', 'PUBLISHED']])->get();
        return View::make('admin.contacts.create')->with(['contact_rows' => $home, 'dynamic_var' => $this->set_variable()]);
    }

    public function set_variable()
    {
        $DynamicVar = [];
        $mobileNo = Config::get('mail.contact_no');
        $emailAddress = Config::get('mail.contact_email');
        $DynamicVar = $mobileNo + $emailAddress;
        return $DynamicVar;
    }

    public function getDetail(Request $request)
    {
        $postRepo = new CmsPostRepository();
        $result = (object)$postRepo->getDetailbyslug($request->slug);
        return View::make('admin.pages.detailByslug')->with(['result' => $result, 'request' => $request]);
    }
}