<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsIndexResource extends JsonResource
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

            'data' => $this->getCollection()->transform(function ($d) {
                return [
                    'id' => $d->id,
                    'title' => $d->title,
                    'subtitle' => $d->subtitle,
                    'admin_name' => $d->admin->name,
                    'created_at' => $d->created_at->format('Y-m-d H:i:s'),
                ];
            }),
            'total' => $this->total(),
            'count' => $this->count(),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'link_to_next_page' => $this->nextPageUrl(),
            'prev_link_page' => $this->previousPageUrl()

        ];
    }
}
