<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubcatChildController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AttributionController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\Admin\AddCompany;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SeosearchController;
use App\Http\Controllers\SkillCategoryController;



// use App\Http\Controllers\swapcontroller;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanFeatureController;
use App\Http\Controllers\PlanSubscriptionController;
use App\Http\Controllers\PaymentContorller;
use App\Http\Controllers\PortfolioItemController;
use App\Http\Controllers\ReviewController;

// use App\Http\Controllers\CompanyController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('/example', 'welcome');

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::post('/stripe/webhook', [PaymentContorller::class, 'handle']);

Route::get('/auth/linkedin', [AuthController::class, 'redirectToLinkedin'])->name('auth.linkedin');
Route::get('/auth/linkedin/callback', [ AuthController::class, 'handleLinkedinCallback'] );

Route::get('/auth/linkedin/claim/{user_id}', [ AuthController::class, 'redirectToLinkedinClaimProfile' ] )->name( 'claim-your-profile' );
Route::get('/linkedin/callback_claim_profile', [ AuthController::class, 'handleLinkedinCalimYourProfile'] );
Route::get('verify-email/{token}', [AuthController::class,'verifyEmail'])->name('verify.email');



/*****************Abandoned*******************/

Route::get('/signin', [HomeController::class, 'signin'])->name('signin');
Route::post('/showLocationsFromService', [HomeController::class, 'showLocationsFromService']);
Route::get('/showcompaniese', [HomeController::class, 'showCompaniesToLocations']);
Route::get('/company-profile/{company_id}', [HomeController::class, 'companyProfile']);
Route::get('/companies', [HomeController::class, 'companies'])->name('company');
Route::get('/get-company', [HomeController::class, 'getCompany'])->name('get-company');
Route::get('/get-search', [HomeController::class, 'getSearchList'])->name('get-search');
// Route::get('/seo/search', [SearchController::class, 'Seosearch'])->name('seo-search');

/*****************Abandoned*******************/

Route::post('/sendCompanycontactEmail', [HomeController::class, 'sendCompanycontactEmail']);
Route::get('/membership-plans', [HomeController::class, 'getPriceListing'])->name('plans');
Route::get('/plans-compare', [HomeController::class, 'getPlancompare'])->name('plans.compare');
Route::get('/company-contact/{company_id}', [HomeController::class, 'companyContact']);
Route::get('get-listed', [HomeController::class, 'getListed'])->name('get-listed');

/*search start*/
Route::post('/get-location', [SearchController::class, 'get_location'])->name('get-location');

Route::post('/directory/{name}/{loc}', [SearchController::class, 'companies'])->name('directory');
Route::get('/directory/{name}/{loc}', [SearchController::class, 'companies'])->name('agency');

Route::post('/directory/{name}', [SearchController::class, 'companies'])->name('in-directory');



Route::get('/directory/{name}/{loc?}', [SearchController::class, 'companies'])->name('in');

Route::get('/search/city-select2', [SearchController::class, 'get_searched_city_select2'])->name('select2-cities');
Route::get('/test1/{name}/{loc?}', [SearchController::class, 'test1'])->name('in');

Route::get('/get-search-list', [SearchController::class, 'getSearchList'])->name('get-search-list');
Route::get('/get-company-list', [SearchController::class, 'getCompany'])->name('get-company-list');
Route::get('/review/{company}', [SearchController::class, 'review'])->name('review');
Route::get('company/reviews', [SearchController::class, 'listView'])->name('reviews.listView');

Route::get('/profile/{company}', [SearchController::class, 'companyProfile'])->name('profile');
Route::get('/test/{company}', [UserController::class, 'test'])->name('test');
Route::get('/api/subcategories', [UserController::class, 'subcategories']);
Route::get('/api/skill', [UserController::class, 'skill']);
Route::get('/api/subskill', [UserController::class, 'subskill']);


/*search end*/

Route::get('/company/{company}/review', [HomeController::class, 'review'])->name('company.review');
Route::post('/get-review-validation-step', [HomeController::class, 'validationStep'])->name('get-review-validation-step');

Route::get('contact', [HomeController::class, 'contact']);

Route::post('sendContactEmail', [HomeController::class, 'sendContactEmail']);

Route::post('/subscribe-newsletter', [ HomeController::class, 'subscribeNewsletter'] )->name('subscribe');


Route::get('claim-profile-status', function(){
    return view( 'home.companyClaimProfileStatus' );
});


Route::get('/sponsorship', [HomeController::class, 'getPriceListing']);
//////////////////////////////////////////
Route::middleware('auth')->group(function(){
    
    //user
    Route::get('/user', [HomeController::class, 'index'])->name('home');
    // Route::get('/sponsorship', [HomeController::class, 'getPriceListing']);
    Route::get('/company/{company}/dashboard', [UserController::class, 'dashboard'])->name('company.dashboard');

    Route::post('/get-listed-validation-step', [UserController::class, 'validationStep'])->name('get-listed-validation-step');

    Route::get('/user/choice', [UserController::class, 'choice'])->name('user.choice');




    Route::post( '/user/choose-plan', [ HomeController::class, 'saveChoosenPlan' ] );





    Route::get('/user/personal', [UserController::class, 'personal'])->name('user.personal');
    Route::post('/user/{user}/savePersonal', [UserController::class, 'savePersonal'])->name('user.savePersonal');
    Route::get( '/company/{company_id}/industry', [ AddCompany::class, 'getdataIndustry'] )->name( 'company.industry' );

    Route::get('/user/{user}/basicInfo', [UserController::class, 'basicInfo'])->name('user.basicInfo');

    Route::get('/user/{user}/allinfo', [UserController::class, 'allInfo'])->name('user.allinfo');

    Route::post('/user/saveBasicInfo', [UserController::class, 'saveBasicInfo'])->name('user.saveBasicInfo');

    Route::get('/company/{company}/location', [UserController::class, 'location'])->name('company.location');
    Route::post('/company/location', [UserController::class, 'savelocation'])->name('company.savelocation');

    Route::get( '/company/location/delete/{loc_id}', [UserController::class, 'deleteLocation'] )->name('delete-location-by-id');

    Route::get('/company/{company}/focus', [UserController::class, 'focus'])->name('company.focus');
    Route::post('/company/focus', [UserController::class, 'saveFocus'])->name('company.saveFocus');


    Route::post('/company/marketing', [UserController::class, 'saveAdminInfo'])->name('company.saveAdminInfo');

    Route::post('get-subcat-children', [UserController::class,'getSubcatChild']);
    Route::post('get-country', [UserController::class,'getCountry']);
    Route::post('get-states-by-country', [UserController::class,'getState']);
    Route::post('get-cities-by-state', [UserController::class,'getCity']);

    Route::get('/company/{company}/getReview', [HomeController::class, 'getReview'])->name('company.getReview');
    Route::Post('/get-review-save', [HomeController::class, 'saveReview'])->name('saveReview');

    Route::get( '/review/states', [ CompanyController::class, 'get_states_by_country' ] );
    Route::get( '/review/cities', [ CompanyController::class, 'get_cities_by_state' ] );

    //admin
    Route::middleware('isAdmin')->group( function(){
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

        Route::get('/admin/category/show', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/admin/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/admin/category/{category}/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/admin/category/{category}/destroy', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::post('/admin/category/set-priority', [CategoryController::class, 'set_priority'])->name('admin.category.set_priority');
            Route::get('admin/seo-search', [SeosearchController::class,'index'])->name('admin.seo-search');
            Route::get('/upload-seo-excel', [SeosearchController::class, 'showForm']);
            Route::post('/upload-seo-excel', [SeosearchController::class, 'importExcel']);
            Route::put('/seo/{id}', [SeosearchController::class, 'update'])->name('seo.update');
            Route::delete('/seo/{id}', [SeosearchController::class, 'destroy'])->name('seo.destroy');
        Route::get('/file-import',[SeosearchController::class,'importView'])->name('import-view'); 
        Route::post('/import',[SeosearchController::class,'import'])->name('import'); 
        Route::get('/export-users',[SeosearchController::class,'exportUsers'])->name('export-users');



        // Company

        Route::get( '/admin/company/add/{user_id?}/{company_id?}', [ AddCompany::class, 'add_company_and_user'] )->name( 'admin.company.add' );
        Route::post( '/admin/company/save', [ AddCompany::class, 'save_company_and_user' ] )->name( 'admin.company.save' );

        Route::get( '/admin/company/{company_id}/{user_id}/location/', [ AddCompany::class, 'add_company_location' ])->name( 'admin.company.location' );
        Route::post( '/admin/company/save-location', [ AddCompany::class, 'save_company_location'] )->name( 'admin.company.save-location' );
        
        Route::get( '/admin/company/{company_id}/focus', [ AddCompany::class, 'add_company_focus'] )->name( 'admin.company.focus' );

        Route::post('/admin/company/save-focus', [AddCompany::class, 'save_company_focus'])->name('admin.company.savefocus');
        // Route::post('/admin/company/save-Service', [AddCompany::class, 'save_company_service'])->name('admin.company.savefocus');

        Route::get('/admin/company/{company_id}/admin-info', [AddCompany::class, 'add_admin_info'] )->name('admin.company.admininfo');
        Route::post('/admin/company/save-admin-info', [AddCompany::class, 'save_company_admin_info'] )->name('admin.company.save-admininfo');


        Route::post( 'admin/send-reviwer-mail', [ HomeController::class, 'send_email_to_reviewer'] );

        Route::get('admin/company/review/email-logs', [ HomeController::class, 'company_review_email_logs'] )->name('admin.review.email.logs');
        Route::get('/admin/subcategory/show', [SubCategoryController::class, 'index'])->name('admin.subcategory.index');
        Route::get('/admin/subcategory/create', [SubCategoryController::class, 'create'])->name('admin.subcategory.create');
        Route::post('/admin/subcategory/store', [SubCategoryController::class, 'store'])->name('admin.subcategory.store');
        Route::get('/admin/subcategory/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('admin.subcategory.edit');
        Route::put('/admin/subcategory/{subcategory}/update', [SubCategoryController::class, 'update'])->name('admin.subcategory.update');
        Route::delete('/admin/subcategory/{subcategory}/destroy',[SubCategoryController::class,'destroy'])->name('admin.subcategory.destroy');
        Route::post('/admin/subcategory/set-priority',[SubCategoryController::class, 'set_priority'])->name('admin.subcategory.set_priority');
        
        // by vipin
       
///////skill controller/////


Route::get('admin/skills/index', [SkillCategoryController::class, 'index'])->name('admin.skills.index');
Route::get('admin/skills/create', [SkillCategoryController::class, 'create'])->name('admin.skills.create');
Route::get('admin/skills/{id}/edit', [SkillCategoryController::class, 'edit'])->name('admin.skills.edit');
Route::post('/admin/skills', [SkillCategoryController::class, 'store'])->name('admin.skills.store');
Route::put('admin/skills/{id}', [SkillCategoryController::class, 'update'])->name('admin.skills.update');
Route::delete('/admin/skills/{skill}', [SkillCategoryController::class, 'destroy'])->name('admin.skills.destroy');



        Route::get('admin/subcategory-child/show', [SubcatChildController::class, 'index'])->name('admin.subcategory-child.show');
		Route::get('admin/subcategory-child/create', [SubcatChildController::class, 'create'])->name('admin.subcategory-child.create');
		Route::post('admin/subcategory-child/store', [SubcatChildController::class, 'store'])->name('admin.subcategory-child.store');
		Route::get('/admin/subcategory-child/{subcategorychild}/edit', [SubcatChildController::class, 'edit'])->name('admin.subcategory-child.edit');
		Route::put('/admin/subcategory-child/{subcategorychild}/update', [SubcatChildController::class, 'update'])->name('admin.subcategory-child.update');
		Route::delete('/admin/subcategory-child/{subcategorychild}/destroy', [SubcatChildController::class, 'destroy'])->name('admin.subcategory-child.destroy');
        



        Route::get('admin/company/list', [CompanyController::class, 'company_list'])->name('admin.company.list');
        
        Route::post('admin/publish-company', [CompanyController::class, 'publish_company'])->name('admin.publish_company');

        Route::post('admin/publish-all-company', [CompanyController::class, 'publish_all_company'])->name('admin.publish_all_company');

        Route::post('admin/flag-company', [ CompanyController::class, 'flag_company'] )->name( 'admin.flag_company' );

        
        Route::get('admin/company/review', [CompanyController::class, 'company_review'])->name('admin.company.review');
        Route::get('admin/company/{viewreview}/viewreview', [CompanyController::class, 'view_reviews'])->name('admin.company.viewreview');
        Route::get('admin/company/{viewreview}/edit', [CompanyController::class, 'edit_review'])->name('admin.company.editreview');
        Route::put('admin/company/{viewreview}/update', [CompanyController::class, 'update_review'])->name('admin.company.update');

        Route::post('admin/publish-review', [CompanyController::class, 'publish_review'])->name('admin.publish_review');
        Route::post('admin/publish-all-review', [CompanyController::class, 'publish_all_review'])->name('admin.publish_all_review');
        Route::get('admin/review/{review}/edit', [CompanyController::class, 'review_edit'])->name('admin.review.edit');
        Route::put('admin/review/update', [CompanyController::class, 'review_update'])->name('admin.review.update');

        Route::get('admin/attribution/show', [AttributionController::class, 'index'])->name('admin.attribution.show');
        Route::get('/admin/attribution/create', [AttributionController::class, 'create'])->name('admin.attribution.create');
        Route::post('/admin/attribution/store', [AttributionController::class, 'store'])->name('admin.attribution.store');
        Route::get('/admin/attribution/{attribution}/edit', [AttributionController::class, 'edit'])->name('admin.attribution.edit');
        Route::put('/admin/attribution/{attribution}/update', [AttributionController::class, 'update'])->name('admin.attribution.update');
        Route::delete('/admin/attribution/{attribution}/destroy', [AttributionController::class, 'destroy'])->name('admin.attribution.destroy');
        
        Route::get('admin/size/show', [SizeController::class, 'index'])->name('admin.size.show');
        Route::get('/admin/size/create', [SizeController::class, 'create'])->name('admin.size.create');
        Route::post('/admin/size/store', [SizeController::class, 'store'])->name('admin.size.store');
        Route::get('/admin/size/{size}/edit', [SizeController::class, 'edit'])->name('admin.size.edit');
        Route::put('/admin/size/{size}/update', [SizeController::class, 'update'])->name('admin.size.update');
        Route::delete('/admin/size/{size}/destroy', [SizeController::class, 'destroy'])->name('admin.size.destroy');

        Route::get('admin/rate/show', [RateController::class, 'index'])->name('admin.rate.show');
        Route::get('/admin/rate/create', [RateController::class, 'create'])->name('admin.rate.create');
        Route::post('/admin/rate/store', [RateController::class, 'store'])->name('admin.rate.store');
        Route::get('/admin/rate/{rate}/edit', [RateController::class, 'edit'])->name('admin.rate.edit');
        Route::put('/admin/rate/{rate}/update', [RateController::class, 'update'])->name('admin.rate.update');
        Route::delete('/admin/rate/{rate}/destroy', [RateController::class, 'destroy'])->name('admin.rate.destroy');

        Route::get('admin/budget/show', [BudgetController::class, 'index'])->name('admin.budget.show');
        Route::get('/admin/budget/create', [BudgetController::class, 'create'])->name('admin.budget.create');
        Route::post('/admin/budget/store', [BudgetController::class, 'store'])->name('admin.budget.store');
        Route::get('/admin/budget/{budget}/edit', [BudgetController::class, 'edit'])->name('admin.budget.edit');
        Route::put('/admin/budget/{budget}/update', [BudgetController::class, 'update'])->name('admin.budget.update');
        Route::delete('/admin/budget/{budget}/destroy', [BudgetController::class, 'destroy'])->name('admin.budget.destroy');

        Route::get('admin/users/list', [CompanyController::class, 'users_list'])->name('admin.users.list');
        Route::get('admin/users/{user}/edit', [CompanyController::class, 'users_edit'])->name('admin.users.edit');
        Route::put('/admin/user/{user}/update', [CompanyController::class, 'users_update'])->name('admin.user.update');
        Route::post('admin/publish-user', [CompanyController::class, 'publish_company'])->name('admin.publish_user');
        Route::post('admin/publish-all-users', [CompanyController::class, 'publish_all_company'])->name('admin.publish_all_users');
        Route::delete('/admin/user/{user}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        Route::resource('plans', PlanController::class);
        // Route::resource('planfeatures', PlanFeatureController::class);
        Route::resource('plansubscription', PlanSubscriptionController::class);
    });    
    Route::get('/checkout', [PaymentContorller::class, 'checkout'])->name('checkout');
    Route::post('/user/choose-plan', [PaymentContorller::class, 'choosePlan'])->name('user.choosePlan');
    Route::post('/create-checkout-session', [PaymentContorller::class, 'createCheckoutSession']);
   
    Route::get('/send-email/{userId}', [PaymentContorller::class, 'sendEmailWithPdf'])->name('send.email.with.pdf');
    Route::resource('planfeatures', PlanFeatureController::class);
    Route::get('/company/{company}/projects', [CompanyController::class, 'CompnayProjectIndex'])->name('projects.index');
    // Route::Post('store', [CompanyController::class, 'CompnayProjectStore'])->name('projects.store');
    // Route::get('/projects/{id}/edit', [CompanyController::class, 'CompnayProjectEdit'])->name('projects.edit');
    // Route::put('/projects/{id}', [CompanyController::class, 'update'])->name('projects.update');
    Route::resource('Projects','App\Http\Controllers\ProjectController');
    
    // Route::resource('planfeatures', PlanFeatureController::class)->except([
    //     'update' 
    // ]);
   // Route::put('planfeatures/{planfeature}', [PlanFeatureController::class,'update'])->name('planfeatures.update');



});

Route::get('/subscribe/{plan}/{user}', [PaymentContorller::class, 'subscribeToPlan']);
Route::post('/company/save-Service/{id}', [AddCompany::class, 'save_company_service'])->name('company.savefocus');
Route::post('/company/save-industry/{id}', [AddCompany::class, 'save_company_industry'])->name('admin.company.industry');
Route::get('/companydata/{id}/', [AddCompany::class, 'getdata']);
Route::get('/industry/{id}/', [AddCompany::class, 'industryData']);
Route::get('/company/{company}/marketing', [UserController::class, 'adminInfo'])->name('company.marketing');


Route::get('portfolio/create', [PortfolioItemController::class, 'create'])->name('portfolio.create');
Route::post('portfolio', [PortfolioItemController::class, 'store'])->name('portfolio.store');
Route::get('/portfolio/{company}', [PortfolioItemController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{company}/data', [PortfolioItemController::class, 'getData'])->name('portfolio.data');

Route::get('company/portfolio_items', [PortfolioItemController::class, 'tableView'])->name('portfolio_items.tableView');
Route::get('portfolio_items/{portfolio_item}/edit', [PortfolioItemController::class, 'edit'])->name('portfolio_items.edit');
Route::put('portfolio_items/{portfolio_item}', [PortfolioItemController::class, 'update'])->name('portfolio_items.update');
Route::delete('portfolio_items/{portfolio_item}', [PortfolioItemController::class, 'destroy'])->name('portfolio_items.destroy');
Route::get('company/request', [ReviewController::class, 'index'])->name('comapany.reviews.request.index');
Route::post('company/reviews-request', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('company/reviews-request/resend/{id}', [ReviewController::class, 'resend'])->name('reviews.resend');
Route::get('/portfolio/{company}', [SearchController::class, 'portfolio'])->name('portfolio');
Route::post('/signup-email', [AuthController::class,"signupWithEmail"])->name('signup.email');
Route::post('/login-email', [AuthController::class,"loginWithEmail"])->name('login.email');
Route::post('/portfolio-items/reorder', [PortfolioItemController::class, 'reorder'])->name('portfolio_items.reorder');
Route::post('/submit-response', [ReviewController::class,'submitResponse'])->name('submit.response');


Route::get('/categories', [SearchController::class, 'getCategories']);
// Route::get('/listing', [SearchController::class, 'listing'])->name('listing');
// routes/web.php
Route::get('/listing/{category?}/{subcategory?}/{skill?}/{subskill?}', [SearchController::class, 'listing'])->name('listing');

Route::get('/api/categories/{id}/subcategories', [SearchController::class, 'getSubcategories']);
Route::get('/api/subcategories/{id}/skills', [SearchController::class, 'getSkills']);
Route::get('/api/skills/{id}/deepskills', [SearchController::class, 'getDeepSkills']);
Route::get('/api/companies', [SearchController::class, 'index']);
Route::get('/api/location', [SearchController::class, 'getLocation']);















