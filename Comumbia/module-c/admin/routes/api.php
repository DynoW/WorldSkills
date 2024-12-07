<?php

use App\Http\Controllers\LoginController;
use App\Models\Participant;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/ntza', function () {
    return view('welcome');
});

Route::prefix('/olympics')->group(function () {
    Route::controller(LoginController::class);

    Route::prefix('/events')->group(function () {
        Route::post('/create', function (Request $request) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:64',
                'date' => 'required|date',
                'venue_id' => 'required|integer|max:11'
            ]);

            try {
                $event = Event::create($validatedData);
                return response()->json($event, 201);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Request error'], 400);
            }
        });

        Route::get('/list', function () {
            $events = Event::all();
            if ($events->isEmpty())
                return abort(404);
            return response()->json($events, 200);
        });

        Route::put('/edit/{idevent}', function ($idevent, Request $request) {
            $validatedData = $request->validate([
                'date' => 'required|date',
            ]);

            $event = Event::find($idevent);
            if (!$event) {
                return response()->json(['error' => 'Event not found'], 404);
            }

            try {
                Event::update($validatedData);
                return response()->json($event, 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Request error'], 400);
            }
        });
    });

    Route::prefix('/participants')->group(function () {
        Route::post('/create', function (Request $request) {
            $validatedData = $request->validate([
                'fullname' => 'required|string|max:64',
                'email' => 'required|string|max:64',
                'phone' => 'required|string|max:64',
                'event_id' => 'required|integer|max:11'
            ]);

            try {
                $participant = Participant::create($validatedData);
                return response()->json($participant, 201);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Request error.'], 400);
            }
        });

        Route::get('/list/{idevent}', function ($idevent) {
            try {
                $participants = Participant::query()->where('event_id', $idevent)->get();
                return response()->json($participants, 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Resource not found.'], 400);
            }
        });

        Route::delete('/delete/{id}', function ($id) {
            try {
                $participant = Participant::find($id);
                if (!$participant) {
                    return response()->json(['error' => 'Participant not found'], 404);
                }
                $participant->delete();
                return response()->json($participant, 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Request error.'], 400);
            }
        });
    });
});
