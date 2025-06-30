<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Property;
use App\Mail\PropertySubmissionMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function showRegistrationForm()
    {
        return view('frontend.seller.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'seller'; // store role as 'seller' lowercase as per your request
        $user->save();

        return redirect()->route('seller.login')->with('success', 'Registration successful. Please login.');
    }

    public function showLoginForm()
    {
        return view('frontend.seller.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'seller') {
                $request->session()->regenerate();
                // Redirect explicitly to seller dashboard after login
                return redirect()->route('seller.dashboard');
            }
            Auth::logout();
            return back()->withErrors([
                'email' => 'You are not authorized as a seller.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        $agents = User::where('role', 'agent')->get();
        $pstate = DB::table('states')->get();
        $propertytype = DB::table('property_types')->get();
        $amenities = DB::table('amenities')->get();
        
        return view('frontend.seller.dashboard', compact('agents', 'pstate', 'propertytype', 'amenities'));
    }

    public function submitProperty(Request $request)
    {
        \Log::info('submitProperty method called');
        $request->validate([
            'property_name' => 'required|string|max:255',
            'property_status' => 'required|in:rent,buy',
            'amenities_id' => 'required|array',
            'lowest_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'garage' => 'required|numeric',
            'garage_size' => 'required|numeric',
            'property_description' => 'required|string',
            'agent_id' => 'required|exists:users,id',
            'property_thambnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Handle thumbnail upload
            $thumbnail = $request->file('property_thambnail');
            $thumbnailName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('upload/property/thumbnail'), $thumbnailName);

            // Handle multiple images
            $multiImages = [];
            if ($request->hasFile('multi_img')) {
                foreach ($request->file('multi_img') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('upload/property/multi-image'), $imageName);
                    $multiImages[] = $imageName;
                }
            }

            // Create property record
            $property = new Property();
            $property->property_name = $request->property_name;
            $property->property_status = $request->property_status;
            $property->amenities_id = json_encode($request->amenities_id);
            $property->lowest_price = $request->lowest_price;
            $property->max_price = $request->max_price;
            $property->bedrooms = $request->bedrooms;
            $property->bathrooms = $request->bathrooms;
            $property->garage = $request->garage;
            $property->garage_size = $request->garage_size;
            $property->short_descp = $request->property_description;
            $property->property_thambnail = $thumbnailName;
            $property->property_slug = Str::slug($request->property_name);
            $property->property_code = 'PROP' . rand(1000, 9999);
            $property->agent_id = $request->agent_id;
            $property->ptype_id = $request->ptype_id;
            $property->save();

            // Get agent and seller information
            $agent = User::findOrFail($request->agent_id);
            $sellerName = Auth::user()->name;

            // Prepare property data for email
            $propertyData = [
                'property_name' => $request->property_name,
                'property_status' => $request->property_status,
                'lowest_price' => $request->lowest_price,
                'max_price' => $request->max_price,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'garage' => $request->garage,
                'garage_size' => $request->garage_size,
                'property_description' => $request->property_description,
                'property_thambnail' => $thumbnailName
            ];

            // Send email to agent
            try {
                Mail::to($agent->email)->send(new PropertySubmissionMail($propertyData, $sellerName));
            } catch (\Exception $mailException) {
                \Log::error('Property submission mail error: ' . $mailException->getMessage());
                return redirect()->back()->with('error', 'Property submitted but failed to send email to the agent.');
            }
            
            return redirect()->back()->with('success', 'Property submitted successfully and email sent to the agent.');
        } catch (\Exception $e) {
            \Log::error('Property submission error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while submitting the property. Please try again.');
        }
    }
}
