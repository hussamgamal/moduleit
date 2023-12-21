<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $table = "attachments";
    protected $fillable = [
        'type',
        'path',
        'thumbnail'
    ];

    protected $hidden = ['created_at', 'updated_at' , 'attached_type', 'attached_id'];

    protected $appends = ['file_type'];

    public function setPathAttribute($file)
    {
        if (is_uploaded_file($file)) {
            $folder = $this->table ?? strtolower($this->model) ?? 'images';
            $this->attributes['path'] = $path = $file->store("uploads/" . $folder);
            $this->attributes['type'] = getFileType($path);
            // $this->attributes['path'] = $file->storeAs("uploads/" . $folder, time() . '-' . urlencode($file->getClientOriginalName()));
        }
    }

    public function getPathAttribute($file)
    {
        return $file ? url($file) : url('placeholders/image.png');
    }

    public function getFileTypeAttribute()
    {
        return getFileType($this->path);
    }

    public function getThumbnailAttribute($thumbnailPath)
    {
        return null;
        if (getFileType($this->path) == 'video' && !$thumbnailPath) {
            $thumbnailPath = getVideoThumbnail($this->getRawOriginal('path'));
            Attachment::find($this->id)->update([
                'thumbnail' => $thumbnailPath,
            ]);
        }
        return $thumbnailPath ? url($thumbnailPath) : null;
    }
}
