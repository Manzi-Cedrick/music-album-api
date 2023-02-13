<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongModel extends Model
{
    use HasFactory;

    protected $table = 'songs';

    protected $fillable = [
        'song_id',
        'title',
        'artist',
        'length',
        'genre',
        'album'
    ];

    public function getSong($id)
    {
        return $this->where('song_id', $id)->first();
    }

    public function getAllSongs()
    {
        return $this->all();
    }

    public function createSong($song)
    {
        return $this->create($song);
    }

    public function updateSong($id, $song)
    {
        return $this->where('song_id', $id)->update($song);
    }

    public function deleteSong($id)
    {
        return $this->where('song_id', $id)->delete();
    }
}
