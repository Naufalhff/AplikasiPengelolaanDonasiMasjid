<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function getDataById($id)
    {
        $event = Event::find($id);
    
        if ($event) {
            return response()->json($event);
        }
    
        return response()->json(['message' => 'Event not found'], 404);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|in:INFAQ,ZAKAT,SEDEKAH,KEGIATAN',
            'deskripsi_kegiatan' => 'required|string',
            'anggaran_kegiatan' => 'required|numeric',
            'penerima_manfaat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $event = Event::create([
            'foto_kegiatan' => $request->foto_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'anggaran_kegiatan' => $request->anggaran_kegiatan,
            'anggaran_terkumpul' => 0,
            'penerima_manfaat' => $request->penerima_manfaat,
        ]);

        return response()->json($event, 201);
    }

    public function update(Request $request, $id_kegiatan)
    {
        $event = Event::find($id_kegiatan);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'foto_kegiatan' => 'required|string',
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|in:INFAQ,ZAKAT,SEDEKAH,KEGIATAN',
            'deskripsi_kegiatan' => 'required|string',
            'anggaran_kegiatan' => 'required|numeric',
            'penerima_manfaat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $event->update([
            'foto_kegiatan' => $request->foto_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'anggaran_kegiatan' => $request->anggaran_kegiatan,
            'penerima_manfaat' => $request->penerima_manfaat,
        ]);

        return response()->json($event);
    }

    public function destroy($id_kegiatan)
    {
        $event = Event::find($id_kegiatan);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
