<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function profile() {
        $member_id = request()->get('member');
        if(isset($member_id)) {
            $user = User::where('member_id',$member_id)->first();
        } else {
            $user = Auth::user();
        }
        $members = User::approved()->where('id','!=',Auth::id())->get();
        return view('profile.profile',compact('user','members'));
    }

    public function loadPost() {
        $perPage = 10; // Number of records per page
        $page = request()->get('page', 1); // Get the page number from the request
        $member_id = request()->get('member');
        if(isset($member_id)) {
            $user = User::where('member_id',$member_id)->first();
        } else {
            $user = Auth::user();
        }
        $post = Post::query();
        if(isset($member_id) && !empty($member_id) && $member_id != 0) {
            $post->where('user_id',$user->id);
        }
        $posts = $post->latest()->paginate($perPage, ['*'], 'page', $page);
        return view('profile.post_div',compact('posts'));
    }

    /**
     * Make a new post
     * @param Request $request
     */
    public function submitPost(Request $request)
    {
        $this->validate($request,['post_content' => 'required|max:5000']);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->post_content = $request->post_content;
        $post->like_count = 0;
        if($request->hasFile('files')) {
            $file_name = [];
            foreach($request->file('files') as $file){
                $fileName = uploadFile($file);
                array_push($file_name,$fileName);
            }
            $post->files = implode(',',$file_name);
        }
        $post->save();
        return redirect()->route('profile');
    }

    public function editProfileForm() {
        $user = Auth::user();
        return view('profile.edit_profile',compact('user'));
    }

    public function updateProfileForm(Request $request) {
        $this->validate($request,[
            'name' => 'required|max:50',
            'mobile' => 'required|max:11',
            'email' => 'max:50',
        ]);
        $user = Auth::user();
        $user->engineer_type_id = $request->engineer_type_id ?? null;
        $user->name = $request->name ?? null;
        $user->mobile = $request->mobile ?? null;
        $user->email = $request->email ?? null;
        $user->national_id = $request->national_id ?? null;
        $user->date_of_birth = $request->date_of_birth ?? null;
        $user->gender = $request->gender ?? null;
        $user->blood_group = $request->blood_group ?? null;
        $user->present_address = $request->present_address ?? null;
        $user->permanent_address = $request->permanent_address ?? null;
        $user->about_me = $request->about_me ?? null;
        $user->father_name = $request->father_name ?? null;
        $user->mother_name = $request->mother_name ?? null;
        $user->profession = $request->profession ?? null;
        $user->profession_details = $request->profession_details ?? null;
        $user->present_company = $request->present_company ?? null;
        $user->present_designation = $request->present_designation ?? null;
        if(isset($request->image) && $request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().$image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            //$image_resize->resize(100, 100);
            $image_resize->save('assets/images/' .$imageName);
            $user->image = 'assets/images/'.$imageName;
        }
        if(isset($request->cover_photo) && $request->hasFile('cover_photo')) {
            if($user->cover_photo != Null && file_exists($user->cover_photo)) {
                unlink($user->cover_photo);
            }
            $image = $request->file('cover_photo');
            $imageName = time().$image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1148, 272);
            $image_resize->save('assets/images/' .$imageName);
            $user->cover_photo = 'assets/images/'.$imageName;
        }
        $user->extracurricular_activities = $request->extracurricular_activities ? json_encode($request->extracurricular_activities) : null;
        $user->hobbies_and_interest = $request->hobbies_and_interest ? json_encode($request->hobbies_and_interest) : null;
        if(isset($request->degree_title) && count($request->degree_title)) {
            UserEducation::whereIn('user_id',array($user->id))->delete();
            foreach ($request->degree_title as $key=> $title) {
                $education = new UserEducation();
                $education->user_id = $user->id;
                $education->degree_title = $request->degree_title[$key] ?? null;
                $education->institute = $request->institute[$key] ?? null;
                $education->passing_year = $request->passing_year[$key] ?? null;
                $education->division_grade = $request->division_grade[$key] ?? null;
                $education->save();
            }
        }
        $user->save();
        return redirect()->route('profile')->with('message',"Profile Information has been updated successfully!");
    }
}
