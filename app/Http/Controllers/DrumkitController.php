<?php 

//// Item / Drum / Drumkit Controller 

namespace App\Http\Controllers; 

use App\Drum; 
use App\Bookmark; 
use App\User; // may not need this 

use Illuminate\Support\Facades\Auth; // may not need 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DrumkitController extends Controller { 
    public function getWelcome() { 
        // if (!Auth::check()) { // user is not logged in }  
        return view('welcome'); 
    } 

    public function postCreateDrum(Request $request) { 
        // validation 
        $drum = new Drum(); 
        // * Item name (may include model/manufacturer) 
        $drum->drumname = $request['drumname']; 
        $drum->cost = (double) $request['cost']; 
        $drum->location = $request['location']; 
        $drum->contact = $request['contact']; 
        $drum->body = $request['body']; // description 
        $file = $request->file('image'); 
        // $filename = $request['email'] . '-' . $drum->id . '.jpg';  
        $filename = $request['drumname'] . '-' . $drum->drumname . '.jpg'; // "$drum->drumname" xhould become "$drum->id" 
        $drum->image = $filename; // image-path 
        if ($file) { 
            Storage::disk('local')->put($filename, File::get($file)); 
        }       
        // * Price 
        $message = 'There was an error'; 
        if ($request->user()->drums()->save($drum)) { 
            $message = 'Item successfully created'; 
        } 
        return redirect()->route('dashboard'); 
    } 

    public function deleteDrum(Request $request) { 
        $drum_id = $request['id']; 
        $drum = Drum::find($drum_id); 
        $drum->delete(); 
        return redirect()->route('dashboard'); 
    } 
    
	public function getDrumImage($filename) { 
		$file = Storage::disk('local')->get($filename);
        return new Response($file, 200);	
	} 

    /// Get Drums View/s  
    public function getDrums() { 
        $drums = Drum::orderBy('created_at', 'desc')->get(); 
        return view('drums', ["drums" => $drums]); 
    } 
    public function getDrumsCheapest() { 
        $drums = Drum::orderBy('cost', 'asc')->get();
        return view('drums', ["drums" => $drums]); 
    } 
    
    public function postBookmarkDrum(Request $request) { 
        $drum_id = $request['drumId']; 
        $is_bookmark = $request['isBookmark'] === 'true';
        $update = false; 
        $drum = Drum::find($drum_id); 
        if (!$drum) { 
            return null; 
        }  
        $user = Auth::user(); 
        $bookmark = $user->bookmarks()->where('drum_id', $drum_id)->first(); 
        if ($bookmark) { 
            $bookmarked = $bookmark->bookmark; 
            $update = true; 
            if ($bookmarked == $is_bookmark) { 
                $bookmark->delete(); 
                return null; 
            }
        } else { 
            $bookmark = new Bookmark(); 
        } 
        $bookmark->bookmark = $is_bookmark; 
        $bookmark->user_id = $user->id; 
        $bookmark->drum_id = $drum->id; 
        if ($update) {
            $bookmark->update();
        } else {
            $bookmark->save();
        }
        return null; 
    } 
} 