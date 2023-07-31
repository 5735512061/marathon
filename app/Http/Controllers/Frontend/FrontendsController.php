<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Contact;
use App\Model\News;
use App\Model\Gallery;

class FrontendsController extends Controller
{
    public function index() {
        $news = News::paginate(6);
        $gallerys = Gallery::paginate(6);
        return view('frontend/index')->with('news',$news)
                                     ->with('gallerys',$gallerys);
    }

    public function news() {
        $news = News::get();
        return view('frontend/news/page-news')->with('news',$news);
    }

    public function newsInformation($id) {
        $news = News::findOrFail($id);
        return view('frontend/news/news-information')->with('news',$news);
    }

    public function galleryInformation($id) {
        $gallery = Gallery::findOrFail($id);
        return view('frontend/gallery/gallery-information')->with('gallery',$gallery);
    }

    public function gallery() {
        $gallerys = Gallery::get();
        return view('frontend/gallery/page-gallery')->with('gallerys',$gallerys);
    }

    public function aboutUs() {
        return view('frontend/about-us/page-about');
    }

    public function contactUs() {
        $contact_id = Contact::value('id');
        $contact = Contact::findOrFail($contact_id);
        return view('frontend/contact-us/page-contact')->with('contact',$contact);
    }
}
