<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;
use App\Model\News;
use App\Model\NewsImageMulti;
use App\Model\Gallery;
use App\Model\GalleryImageMulti;
use App\Model\Contact;
use App\Model\ImageSlide;
use App\Model\ImageLogo;
use App\Model\Counter;
use App\Model\ImageLink;

use DB;
use Auth;
use Validator;

class AdminsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function changeProfileIndex($id){
        $profile = Admin::findOrFail($id);
        return view('backend/admin/profile-change')->with('profile',$profile);
    }

    public function changeProfile(Request $request){
        $validator = Validator::make($request->all(), $this->rules_changeProfile(), $this->messages_changeProfile());
        if($validator->passes()) {
            $id = $request->get('id');
            
            $profile = Admin::findOrFail($id);
            $profile->update($request->all());

            Auth::guard('admin')->logout();
            $request->session()->flash('alert-success', 'เปลี่ยนข้อมูลส่วนตัวสำเร็จ เข้าสู่ระบบอีกครั้ง');
            return redirect('admin/login');
        } else {
            $request->session()->flash('alert-danger', 'เปลี่ยนข้อมูลส่วนตัวไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }
    
    public function news(Request $request) {
        $NUM_PAGE = 10;
        $news = News::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/news/index')->with('NUM_PAGE',$NUM_PAGE)
                                               ->with('page',$page)
                                               ->with('news',$news);
    }

    public function createNews(Request $request) {
        return view('backend/admin/news/create-news');
    }

    public function createNewsPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createNewsPost(), $this->messages_createNewsPost());
        if($validator->passes()) {
            if($request->hasFile('image_main')){
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_news_main/', $filename);
                $path = 'image_upload/image_news_main/'.$filename;

                DB::table('news')->insert([
                    'image_main' => $filename,
                    'admin_id' => $request->get('admin_id'),
                    'title' => $request->get('title'),
                    'title_eng' => $request->get('title_eng'),
                    'date' => $request->get('date'),
                    'news' => $request->get('news'),
                    'news_eng' => $request->get('news_eng'),
                ]);

            }

            $news_id = News::orderBy('id','desc')->value('id');

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_news_multi/'), $filename);

                        $gallery = new NewsImageMulti;
                        $gallery->news_id = $news_id;
                        $gallery->image_multi = $filename;
                        $gallery->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'เพิ่มข้อมูลข่าวสารสำเร็จ');
            return redirect()->action('Backend\AdminsController@news');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มข้อมูลข่าวสารไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function newsImageMultiInfor($id) {
        $image_multis = NewsImageMulti::where('news_id',$id)->get();
        return view('backend/admin/news/image-multi-information')->with('image_multis',$image_multis)
                                                                 ->with('id',$id);
    }

    public function newsDelete($id) {
        $image_multi = NewsImageMulti::where('news_id',$id)->delete();
        News::findOrFail($id)->delete();
        return back();
    }

    public function updateNews(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateNews(), $this->messages_updateNews());
        if($validator->passes()) {
            $id = $request->get('id');
            $news = News::findOrFail($id);
            $news->update($request->all());

            if($request->hasFile('image_main')) {
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_news_main/', $filename);
                $path = 'image_upload/image_news_main/'.$filename;
                $news = News::findOrFail($id);
                $news->image_main = $filename;
                $news->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลข่าวสารสำเร็จ');
            return redirect()->action('Backend\AdminsController@news');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลข่าวสารไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
        
    }

    public function editNews($id) {
        $news = News::findOrFail($id);
        return view('backend/admin/news/edit-news')->with('news',$news);
    }

    public function updateNewsPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateNewsPost(), $this->messages_updateNewsPost());
        if($validator->passes()) {
            $id = $request->get('id');
            $news = News::findOrFail($id);
            $news->update($request->all());
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลข่าวสารสำเร็จ');
            return redirect()->action('Backend\AdminsController@news');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลข่าวสารไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updateNewsImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateNewsImageMulti(), $this->messages_updateNewsImageMulti());
        if($validator->passes()) {
            $id = $request->get('id');
            $news = NewsImageMulti::findOrFail($id);
            $news->update($request->all());

            if($request->hasFile('image_multi')) {
                $image = $request->file('image_multi');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_news_multi/', $filename);
                $path = 'image_upload/image_news_multi/'.$filename;
                $news = NewsImageMulti::findOrFail($id);
                $news->image_multi = $filename;
                $news->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลข่าวสารสำเร็จ');
            return redirect()->action('Backend\AdminsController@news');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลข่าวสารไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function uploadNewsImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_uploadNewsImageMulti(), $this->messages_uploadNewsImageMulti());
        if($validator->passes()) {
            $news_id = $request->get('id');

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_news_multi/'), $filename);

                        $gallery = new NewsImageMulti;
                        $gallery->news_id = $news_id;
                        $gallery->image_multi = $filename;
                        $gallery->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'อัพโหลดรูปภาพสำเร็จ');
            return redirect()->action('Backend\AdminsController@news');
        } else {
            $request->session()->flash('alert-danger', 'อัพโหลดรูปภาพไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function newsImageMultiDelete($id) {
        $image_multi = NewsImageMulti::where('id',$id)->delete();
        return back();
    }

    public function gallery(Request $request) {
        $NUM_PAGE = 10;
        $gallerys = Gallery::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/gallery/index')->with('NUM_PAGE',$NUM_PAGE)
                                                  ->with('page',$page)
                                                  ->with('gallerys',$gallerys);
    }

    public function createGallery(Request $request) {
        return view('backend/admin/gallery/create-gallery');
    }

    public function createGalleryPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createGalleryPost(), $this->messages_createGalleryPost());
        if($validator->passes()) {
            if($request->hasFile('image_main')){
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_gallery_main/', $filename);
                $path = 'image_upload/image_gallery_main/'.$filename;

                DB::table('gallerys')->insert([
                    'image_main' => $filename,
                    'admin_id' => $request->get('admin_id'),
                    'title' => $request->get('title'),
                    'title_eng' => $request->get('title_eng'),
                    'date' => $request->get('date'),
                ]);

            }

            $gallery_id = Gallery::orderBy('id','desc')->value('id');
        

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_gallery_multi/'), $filename);

                        $gallery = new GalleryImageMulti;
                        $gallery->gallery_id = $gallery_id;
                        $gallery->image_multi = $filename;
                        $gallery->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'เพิ่มข้อมูลกิจกรรมสำเร็จ');
            return redirect()->action('Backend\AdminsController@gallery');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มข้อมูลกิจกรรมไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function galleryImageMultiInfor($id) {
        $image_multis = GalleryImageMulti::where('gallery_id',$id)->get();
        $gallery_id = $id;
        return view('backend/admin/gallery/image-multi-information')->with('image_multis',$image_multis)
                                                                    ->with('gallery_id',$gallery_id);
    }

    public function galleryDelete($id) {
        $image_multi = GalleryImageMulti::where('gallery_id',$id)->delete();
        Gallery::findOrFail($id)->delete();
        return back();
    }

    public function updateGallery(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateGallery(), $this->messages_updateGallery());
        if($validator->passes()) {
            $id = $request->get('id');
            $gallery = Gallery::findOrFail($id);
            $gallery->update($request->all());

            if($request->hasFile('image_main')) {
                $image = $request->file('image_main');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_gallery_main/', $filename);
                $path = 'image_upload/image_gallery_main/'.$filename;
                $gallery = Gallery::findOrFail($id);
                $gallery->image_main = $filename;
                $gallery->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลกิจกรรมสำเร็จ');
            return redirect()->action('Backend\AdminsController@gallery');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลกิจกรรมไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updateGalleryImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateGalleryImageMulti(), $this->messages_updateGalleryImageMulti());
        if($validator->passes()) {
            $id = $request->get('id');
            $gallery = GalleryImageMulti::findOrFail($id);
            $gallery->update($request->all());

            if($request->hasFile('image_multi')) {
                $image = $request->file('image_multi');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_gallery_multi/', $filename);
                $path = 'image_upload/image_gallery_multi/'.$filename;
                $gallery = GalleryImageMulti::findOrFail($id);
                $gallery->image_multi = $filename;
                $gallery->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลกิจกรรมสำเร็จ');
            return redirect()->action('Backend\AdminsController@gallery');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลกิจกรรมไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function uploadGalleryImageMulti(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_updateGalleryImageMulti(), $this->messages_updateGalleryImageMulti());
        if($validator->passes()) {
            $gallery_id = $request->get('gallery_id');
        

            if($request->hasFile('image_multi')){
                if($files = $request->file('image_multi')){
                    foreach($files as $file){
                        $filename = md5(($file->getClientOriginalName(). time()) . time()) . "_o." . $file->getClientOriginalExtension();
                        $file->move(public_path('image_upload/image_gallery_multi/'), $filename);

                        $gallery = new GalleryImageMulti;
                        $gallery->gallery_id = $gallery_id;
                        $gallery->image_multi = $filename;
                        $gallery->save();
                        
                    }
                }
            }
            $request->session()->flash('alert-success', 'อัพโหลดรูปภาพสำเร็จ');
            return redirect()->action('Backend\AdminsController@gallery');
        } else {
            $request->session()->flash('alert-danger', 'อัพโหลดรูปภาพไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function galleryImageMultiDelete($id) {
        $image_multi = GalleryImageMulti::where('id',$id)->delete();
        return back();
    }

    public function imageSlide(Request $request) {
        $NUM_PAGE = 10;
        $image_slides = ImageSlide::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/page-website/slide')->with('NUM_PAGE',$NUM_PAGE)
                                                       ->with('page',$page)
                                                       ->with('image_slides',$image_slides);
    }

    public function createSlide(Request $request) {
        return view('backend/admin/page-website/create-slide');
    }

    public function createSlidePost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createSlidePost(), $this->messages_createSlidePost());
        if($validator->passes()) {
            $image_slide = $request->all();
            $image_slide = ImageSlide::create($image_slide);
            if($request->hasFile('image')){
                $slide = $request->file('image');
                $filename = md5(($slide->getClientOriginalName(). time()) . time()) . "_o." . $slide->getClientOriginalExtension();
                $slide->move('image_upload/image_slide/', $filename);
                $path = 'image_upload/image_slide/'.$filename;
                $image_slide->image = $filename;
                $image_slide->save();
            }
            $request->session()->flash('alert-success', 'เพิ่มรูปภาพสไลด์สำเร็จ');
            return redirect()->action('Backend\AdminsController@imageSlide');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มรูปภาพสไลด์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function slideDelete($id) {
        ImageSlide::findOrFail($id)->delete();
        return back();
    }

    public function updateSlide(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createSlidePost(), $this->messages_createSlidePost());
        if($validator->passes()) {
            $id = $request->get('id');
            $image_slide = ImageSlide::findOrFail($id);
            $image_slide->update($request->all());
            if($request->hasFile('image')) {
                $slide = $request->file('image');
                $filename = md5(($slide->getClientOriginalName(). time()) . time()) . "_o." . $slide->getClientOriginalExtension();
                $slide->move('image_upload/image_slide/', $filename);
                $path = 'image_upload/image_slide/'.$filename;
                $image_slide = ImageSlide::findOrFail($id);
                $image_slide->image = $filename;
                $image_slide->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขรูปภาพสไลด์สำเร็จ');
            return redirect()->action('Backend\AdminsController@imageSlide');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขรูปภาพสไลด์ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function imageLogo(Request $request) {
        $NUM_PAGE = 10;
        $image_logos = ImageLogo::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/page-website/logo')->with('NUM_PAGE',$NUM_PAGE)
                                                      ->with('page',$page)
                                                      ->with('image_logos',$image_logos);
    }

    public function createLogo(Request $request) {
        return view('backend/admin/page-website/create-logo');
    }

    public function createLogoPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createLogoPost(), $this->messages_createLogoPost());
        if($validator->passes()) {
            $image_logo = $request->all();
            $image_logo = ImageLogo::create($image_logo);
            if($request->hasFile('image')){
                $logo = $request->file('image');
                $filename = md5(($logo->getClientOriginalName(). time()) . time()) . "_o." . $logo->getClientOriginalExtension();
                $logo->move('image_upload/image_logo/', $filename);
                $path = 'image_upload/image_logo/'.$filename;
                $image_logo->image = $filename;
                $image_logo->save();
            }
            $request->session()->flash('alert-success', 'เพิ่มรูปภาพโลโก้สำเร็จ');
            return redirect()->action('Backend\AdminsController@imageLogo');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มรูปภาพโลโก้ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updateLogo(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createLogoPost(), $this->messages_createLogoPost());
        if($validator->passes()) {
            $id = $request->get('id');
            $image_logo = ImageLogo::findOrFail($id);
            $image_logo->update($request->all());
            if($request->hasFile('image')) {
                $slide = $request->file('image');
                $filename = md5(($slide->getClientOriginalName(). time()) . time()) . "_o." . $slide->getClientOriginalExtension();
                $slide->move('image_upload/image_logo/', $filename);
                $path = 'image_upload/image_logo/'.$filename;
                $image_logo = ImageLogo::findOrFail($id);
                $image_logo->image = $filename;
                $image_logo->save();
            }
            $request->session()->flash('alert-success', 'แก้ไขรูปภาพโลโก้สำเร็จ');
            return redirect()->action('Backend\AdminsController@imageLogo');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขรูปภาพโลโก้ไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function logoDelete($id) {
        ImageLogo::findOrFail($id)->delete();
        return back();
    }

    public function contact() {
        $id = Contact::value('id');
        $contact = Contact::findOrFail($id);
        return view('backend/admin/contact/index')->with('contact',$contact);
    }

    public function createContact(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createContact(), $this->messages_createContact());
        if($validator->passes()) {
            $id = $request->get('id');
            $contact = Contact::findOrFail($id);
            $contact->update($request->all());
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลติดต่อสำเร็จ');
            return redirect()->action('Backend\AdminsController@contact');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลติดต่อไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function countdown(Request $request) {
        $NUM_PAGE = 10;

        $day = Counter::where('status','เปิด')->value('day');
        $month = Counter::where('status','เปิด')->value('month');
        $year = Counter::where('status','เปิด')->value('year');
        $time = Counter::where('status','เปิด')->value('time');

        $js_lang = array(
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'time' => $time
        );

        $countdowns = Counter::paginate($NUM_PAGE);

        $page = $request->input('page');
        $page = ($page != null)?$page:1;

        return view('backend/admin/countdown/index' , ['js_lang' => $js_lang])->with('NUM_PAGE',$NUM_PAGE)
                                                                              ->with('page',$page)
                                                                              ->with('countdowns',$countdowns);
    }

    public function createCountdownPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createCountdownPost(), $this->messages_createCountdownPost());
        if($validator->passes()) {
            $countdown = $request->all();
            $countdown = Counter::create($countdown);
            $request->session()->flash('alert-success', 'เพิ่มข้อมูลนับเวลาถอยหลังสำเร็จ');
            return redirect()->action('Backend\AdminsController@countdown');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มข้อมูลนับเวลาถอยหลังไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function updateCountdown(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_createCountdownPost(), $this->messages_createCountdownPost());
        if($validator->passes()) {
            $id = $request->get('id');
            $countdown = Counter::findOrFail($id);
            $countdown->update($request->all());
            $request->session()->flash('alert-success', 'แก้ไขข้อมูลนับเวลาถอยหลังสำเร็จ');
            return redirect()->action('Backend\AdminsController@countdown');
        } else {
            $request->session()->flash('alert-danger', 'แก้ไขข้อมูลนับเวลาถอยหลังไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function countdownDelete($id) {
        Counter::findOrFail($id)->delete();
        return back();
    }

    public function imageLink(Request $request) {
        $NUM_PAGE = 20;
        $images = ImageLink::paginate($NUM_PAGE);
        $page = $request->input('page');
        $page = ($page != null)?$page:1;
        return view('backend/admin/image-link')->with('NUM_PAGE',$NUM_PAGE)
                                               ->with('page',$page)
                                               ->with('images',$images);
    }

    public function imageLinkPost(Request $request) {
        $validator = Validator::make($request->all(), $this->rules_imageLinkPost(), $this->messages_imageLinkPost());
        if($validator->passes()) {
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = md5(($image->getClientOriginalName(). time()) . time()) . "_o." . $image->getClientOriginalExtension();
                $image->move('image_upload/image_link/', $filename);
                $path = 'image_upload/image_link/'.$filename;
                $image_link = new ImageLink;
                $image_link->image = $filename;
                $image_link->admin_id = $request->get('admin_id');
                $image_link->save();
            }
            $request->session()->flash('alert-success', 'เพิ่มรูปภาพสำเร็จ');
            return redirect()->action('Backend\AdminsController@imageLink');
        } else {
            $request->session()->flash('alert-danger', 'เพิ่มรูปภาพไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง');
            return back()->withErrors($validator)->withInput();
        }
    }

    public function rules_createNewsPost() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'news' => 'required',
            'news_eng' => 'required',
            'date' => 'required',
            'image_main' => 'required',
            'image_multi' => 'required',
        ];
    }

    public function messages_createNewsPost() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อเรื่อง',
            'title_eng.required' => 'กรุณากรอกหัวข้อเรื่อง (ภาษาอังกฤษ)',
            'news.required' => 'กรุณากรอกเนื้อหาข่าวสาร',
            'news_eng.required' => 'กรุณากรอกเนื้อหาข่าวสาร (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี',
            'image_main.required' => 'กรุณาแนบไฟล์รูปภาพหลัก ขนาด 378*300 pixel',
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_createGalleryPost() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
            'image_main' => 'required',
            'image_multi' => 'required',
        ];
    }

    public function messages_createGalleryPost() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อกิจกรรม',
            'title_eng.required' => 'กรุณากรอกหัวข้อกิจกรรม (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี',
            'image_main.required' => 'กรุณาแนบไฟล์รูปภาพหลัก ขนาด 378*300 pixel',
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_createSlidePost() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_createSlidePost() {
        return [
            'image.required' => 'กรุณาแนบไฟล์รูปภาพสไลด์',
        ];
    }

    public function rules_createLogoPost() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_createLogoPost() {
        return [
            'image.required' => 'กรุณาแนบไฟล์รูปภาพโลโก้',
        ];
    }

    public function rules_changeProfile() {
        return [
            'name' => 'required',
            'username' => 'required',
        ];
    }

    public function messages_changeProfile() {
        return [
            'name.required' => 'กรุณากรอกชื่อ',
            'username.required' => 'กรุณากรอกชื่อเข้าใช้งาน',
        ];
    }

    public function rules_updateNews() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
        ];
    }

    public function messages_updateNews() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อเรื่อง',
            'title_eng.required' => 'กรุณากรอกหัวข้อเรื่อง (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี',
        ];
    }

    public function rules_updateNewsPost() {
        return [
            'news' => 'required',
            'news_eng' => 'required',
        ];
    }

    public function messages_updateNewsPost() {
        return [
            'news.required' => 'กรุณากรอกเนื้อหาข่าวสาร',
            'news_eng.required' => 'กรุณากรอกเนื้อหาข่าวสาร (ภาษาอังกฤษ)',
        ];
    }

    public function rules_updateNewsImageMulti() {
        return [
            'image_multi' => 'required',
        ];
    }

    public function messages_updateNewsImageMulti() {
        return [
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_uploadNewsImageMulti() {
        return [
            'image_multi' => 'required',
        ];
    }

    public function messages_uploadNewsImageMulti() {
        return [
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_updateGallery() {
        return [
            'title' => 'required',
            'title_eng' => 'required',
            'date' => 'required',
        ];
    }

    public function messages_updateGallery() {
        return [
            'title.required' => 'กรุณากรอกหัวข้อกิจกรรม',
            'title_eng.required' => 'กรุณากรอกหัวข้อกิจกรรม (ภาษาอังกฤษ)',
            'date.required' => 'กรุณากรอก วัน/เดือน/ปี',
        ];
    }

    public function rules_updateGalleryImageMulti() {
        return [
            'image_multi' => 'required',
        ];
    }

    public function messages_updateGalleryImageMulti() {
        return [
            'image_multi.required' => 'กรุณาแนบไฟล์รูปภาพอื่นๆ ขนาด 378*300 pixel',
        ];
    }

    public function rules_createContact() {
        return [
            'phone' => 'required',
            'facebook' => 'required',
            'youtube' => 'required',
            'ig' => 'required',
            'twitter' => 'required',
            'tiktok' => 'required',
        ];
    }

    public function messages_createContact() {
        return [
            'phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'facebook.required' => 'กรุณากรอกชื่อ FACEBOOK',
            'youtube.required' => 'กรุณากรอกชื่อ YOUTUBE',
            'ig.required' => 'กรุณากรอกชื่อ IG',
            'twitter.required' => 'กรุณากรอกชื่อ Twitter',
            'tiktok.required' => 'กรุณากรอกชื่อ TIKTOk',
        ];
    }

    public function rules_createCountdownPost() {
        return [
            'name' => 'required',
            'day' => 'required',
            'year' => 'required',
            'time' => 'required',
        ];
    }

    public function messages_createCountdownPost() {
        return [
            'name.required' => 'กรุณากรอกชื่อกิจกรรม',
            'day.required' => 'กรุณากรอกวันที่สิ้นสุด',
            'year.required' => 'กรุณากรอกปี ค.ศ. เท่านั้น',
            'time.required' => 'กรุณากรอกเวลา',
        ];
    }

    public function rules_imageLinkPost() {
        return [
            'image' => 'required',
        ];
    }

    public function messages_imageLinkPost() {
        return [
            'image.required' => 'กรุณาแนบไฟล์รูปภาพ',
        ];
    }
    
}
