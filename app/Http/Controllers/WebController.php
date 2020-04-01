<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Experience;
use App\Mail\ContactEmail;
use App\ProfileAttribute;
use App\Project;
use App\School;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Profiler\Profile;

class WebController extends Controller
{
    public function getHome() {
        $profileAttributes = [];
        foreach (ProfileAttribute::get() as $attribute) {
            if ($attribute->name == 'profile_image') {
                $imageData = json_decode($attribute->value);
                $profileAttributes[$attribute->name] = env('MEDIA_URL') . '/' . $imageData->name;
            } else {
                if ($attribute->name == 'github') {
                    $username = str_replace('https://github.com/', '', $attribute->value);
                    $profileAttributes['github_username'] = $username;
                }
                $profileAttributes[$attribute->name] = $attribute->value;
            }
        }
        $projects = Project::get();
        foreach ($projects as $project) {
            $image = $project->project_image()->first();
            if ($image) {
                $project->image = env('MEDIA_URL') . '/' . $image->file_name;
            }
        }
        $skills = Skill::get();
        $conferences = Conference::get();
        $schools = School::get();
        $jobs = Experience::get();
        $showContact = false;
        if (isset($profileAttributes['email'])) {
            if (env('MAIL_DRIVER') && env('MAIL_HOST') && env('MAIL_PORT') && env('MAIL_USERNAME') && env('MAIL_PASSWORD')) {
                $showContact = true;
            }
        }
        return view('home', compact('profileAttributes', 'projects', 'skills', 'conferences', 'schools', 'jobs', 'showContact'));
    }

    public function getContact() {
        $profileAttributes = [];
        foreach (ProfileAttribute::get() as $attribute) {
            if ($attribute->name == 'profile_image') {
                $imageData = json_decode($attribute->value);
                $profileAttributes[$attribute->name] = env('MEDIA_URL') . '/' . $imageData->name;
            } else {
                if ($attribute->name == 'github') {
                    $username = str_replace('https://github.com/', '', $attribute->value);
                    $profileAttributes['github_username'] = $username;
                }
                $profileAttributes[$attribute->name] = $attribute->value;
            }
        }
        $showContact = false;
        return view('contact', compact('profileAttributes', 'showContact'));
    }

    public function postContact(Request $request) {
        $contactDetails = [];
        foreach ($request->all() as $key => $value) {
            $contactDetails[$key] = $value;
        }
        $email = ProfileAttribute::where('name', 'email')->first()->value;
        Mail::to($email)->send(new ContactEmail($contactDetails));
        return redirect()->back()->with('success', 'Email has been sent');
    }
}
