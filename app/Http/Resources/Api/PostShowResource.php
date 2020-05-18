<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class PostShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'admin_id' => $this->admin->name,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'is_liked' => $this->isliked(),
            'is_disliked' => $this->isdisliked(),
            'like_count' => $this->likesCount ?? 0,
            'dislike_count' => $this->dislikesCount ?? 0,
            'comments' => $this->comments()->paginate(3)->transform(function ($e) {
                return [
                    'id' => $e->id,
                    'user_name' => $e->user->name,
                    'body' => $e->body,
                    'created_at' => $e->created_at,
                ];
            }),
            'comments_next_page' => $this->comments()->paginate(3)->nextPageUrl(),
            'comments_prev_page' => $this->comments()->paginate(3)->previousPageUrl(),
        ];
    }
}
