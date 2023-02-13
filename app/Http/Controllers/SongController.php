<?php

namespace App\Http\Controllers;

use App\Models\SongModel;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function getSongs()
    {
        try {
            $Song = new SongModel();

            $songs = $Song->getAllSongs();

            if($songs->count() <= 0) {
                return response()->json([
                    'message' => 'No songs found'
                ]);
            }

            return response()->json([
                'message' => 'Songs retrieved successfully',
                'songs' => $songs
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error retrieving songs',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function getSong(string $songId)
    {
        try {
            $Song = new SongModel();

            $song = $Song->getSong($songId);

            if(!$song) {
                return response()->json([
                    'message' => 'Song not found'
                ]);
            }

            return response()->json([
                'message' => 'Song retrieved successfully',
                'song' => $song
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error retrieving song',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function createSong(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:100',
                'artist' => 'required|string|max:50',
                'length' => 'required|integer',
                'genre' => 'required|string|max:100',
                'album' => 'required|string|max:100|exists:albums,album_id'
            ]);

            $Song = new SongModel();

            $songData = [
                'song_id' => uniqid('song_'),
                'title' => $request->title,
                'artist' => $request->artist,
                'length' => $request->length,
                'genre' => $request->genre,
                'album' => $request->album
            ];
            
            $song = $Song->createSong($songData);

            return response()->json([
                'message' => 'Song created successfully',
                'song' => $song
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error creating song',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function updateSong(Request $request, string $songId)
    {
        try {
            $Song = new SongModel();

            $request->validate([
                'title' => 'required|string|max:100',
                'artist' => 'required|string|max:50',
                'length' => 'required|integer',
                'genre' => 'required|string|max:100',
                'album' => 'required|string|max:100|exists:albums,album_id'
            ]);

            $albumData = [
                'title' => $request->title,
                'artist' => $request->artist,
                'length' => $request->length,
                'genre' => $request->genre,
                'album' => $request->album
            ];

            $song = $Song->updateSong($songId, $albumData);

            if (!$song) {
                return response()->json([
                    'message' => 'Song not found'
                ]);
            }

            return response()->json([
                'message' => 'Song updated successfully',
                'song' => $song
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating song',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function deleteSong(string $songId)
    {
        try {
            $Song = new SongModel();

            $song = $Song->deleteSong($songId);

            if (!$song) {
                return response()->json([
                    'message' => 'Song not found'
                ]);
            }

            return response()->json([
                'message' => 'Song deleted successfully',
                'album' => $song
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error deleting song',
                'error' => $th->getMessage()
            ]);
        }
    }
}
