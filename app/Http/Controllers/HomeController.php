<?php

namespace LaravelAcl\Authentication\Controllers;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use view,
    DB,
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
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\PageManager\app\Models\Page;
use Backpack\NewsCRUD\app\Models\Category as Category;

class HomeController extends Controller {

    protected $auth;
    protected $logged_user;

    public function __construct(AuthenticateInterface $auth) {
        $this->auth = $auth;
        $this->logged_user=$this->auth->getLoggedUser();
    }

    public function getIndex() {
        $info="welcome to web page";
        return View::make('admin.home.index')->with(['user_data' => $this->logged_user, 'info' => $info]);
    }

    /*
      public function howtouse() {
      $page = Page::findBySlugOrId('how-to-use-hub');
      return View::make('admin.pages.howtouse')->with(['page' => $page->withFakes()]);
      }
     */

    public function howtouse() {
        $logged_user = $this->auth->getLoggedUser();
        $page = Page::findBySlugOrId('how-to-use-hub');
        
        $sliders = Article::where([['category_id', 13], ['status', 'PUBLISHED']])->get();
      //  $home = Article::where([['category_id', 4], ['status', 'PUBLISHED']])->get();
        
        return View::make('admin.pages.howtouse')->with(['user_data' => $this->logged_user,'sliders' => $sliders, 'page' => $page->withFakes()]);
        //return View::make('admin.pages.page')->with(['user_data' => $logged_user, 'sliders' => $sliders, 'page' => $page->withFakes(), 'home_rows' => $home]);
    }

    public function encourageactivation() {
        $page = Page::findBySlugOrId('encourage-activation');
        return View::make('admin.pages.encourageactivation')->with(['user_data' => $this->logged_user,'page' => $page->withFakes()]);
    }

    public function brandassets() {
        
        $page = Page::findBySlugOrId('brand-assets');
        $logos = Article::where([['category_id', 2], ['status', 'PUBLISHED']])->get();
        $items = Article::where([['category_id', 5], ['status', 'PUBLISHED']])->get();
        return View::make('admin.pages.brandassets')->with(['user_data' => $this->logged_user,'page' => $page->withFakes(), 'logos' => $logos, 'items' => $items]);
    }

    public function promoteutilization() {
        $videos = Article::where([['category_id', 3], ['status', 'PUBLISHED']])->get();
        $materials = Article::where([['category_id', 6], ['status', 'PUBLISHED']])->get();
        $page = Page::findBySlugOrId('promote-utilization');
        return View::make('admin.pages.promoteutilization')->with(['user' => $this->logged_user, 'page' => $page->withFakes(), 'videos' => $videos, 'materials' => $materials]);
    }

//   public function newsmedia() {
//        $authentication = \App::make('authentication_helper');
//        $auth = \App::make('authenticator');
//        $user = $auth->getLoggedUser();
//
//        $videos = Article::where([['category_id', 3], ['status', 'PUBLISHED']])->get();
//        $materials = Article::where([['category_id', 6], ['status', 'PUBLISHED']])->get();
//        $page = Page::findBySlugOrId('promote-utilization');
//        return View::make('admin.pages.news-media')->with(['user' => $user, 'page' => $page->withFakes(), 'videos' => $videos, 'materials' => $materials]);
//    }

    public function newsmedia() {

        $authentication = \App::make('authentication_helper');
        $auth = \App::make('authenticator');
        $user = $auth->getLoggedUser();

        //$videos = Article::where([['category_id', 3], ['status', 'PUBLISHED']])->get();
        $newsmedia = Article::where([['category_id', 7], ['status', 'PUBLISHED']])->paginate(10);
        $pressrelease = Article::where([['category_id', 8], ['status', 'PUBLISHED']])->paginate(8);
        return View::make('admin.pages.news-media')->with(['user' => $this->logged_user, 'newsmedia' => $newsmedia, 'pressrelease' => $pressrelease]);
    }

    public function resources() {
        $logged_user = $this->auth->getLoggedUser();
        $page = Page::findBySlugOrId('resources');
        $Categories = Category::where('parent_id', 9)->get();
        $cat_id = Category::where('parent_id', 9)->lists('id');
        $Aritcles = Article::whereIn('category_id', $cat_id)->where('status', 'PUBLISHED')->get();
        return View::make('admin.pages.resources')->with(['user_data' => $this->logged_user,'page' => $page->withFakes(), 'categories' => $Categories, 'articles' => $Aritcles]);
    }

}
