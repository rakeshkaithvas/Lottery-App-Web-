<?php
namespace App\Http\Controllers\Admin\ScratchCard;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Scratch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ScratchcardController extends Controller
{
     public function getScratchcards()
        {
            $scratchCards = Scratch::with('creator')->orderBy('id', 'desc')->get();

            return view('Admin.pages.scratch.scratchcards', compact('scratchCards'));
        }

        public function toggleStatus($id)
        {
            $scratch = Scratch::findOrFail($id);

            $scratch->status = $scratch->status === 'active' ? 'inactive' : 'active';
            $scratch->save();

            return back()->with('success', 'Scratch card status updated!');
        }
}
