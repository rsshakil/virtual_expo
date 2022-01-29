<?php

namespace App\Http\Resources\Backend\Webinar;

use Illuminate\Http\Resources\Json\JsonResource;

class WebinarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'speaker'             => $this->speaker,
            'meet_pass'           => $this->meet_pass,
            'schedule_type'       => $this->schedule_type,
            'topic'               => $this->topic,
            'description'         => $this->description,
            'recurrance'          => $this->recurrance,
            'day_dt'              => $this->day_dt,
            'repeat_every'        => $this->repeat_every,
            'start_date'          => $this->start_date,
            'end_date'            => $this->end_date,
            'start_time'          => $this->start_time,
            'end_time'            => $this->end_time,
            // 'duration'            => Carbon::parse($this->end)
            'd_hour'              => $this->d_hour,
            'd_min'               => $this->d_min,
            'class_date_end_time' => $this->class_date_end_time,
            'type'                => $this->type,
            'meeting_id'          => $this->meeting_id,
            'total_meeting'       => $this->total_meeting,
            'host_id'             => $this->host_id,
            'start_url'           => $this->start_url,
            'join_url'            => $this->join_url,
            'cancel_status'       => $this->cancel_status,
            'timezone'            => $this->timezone,
        ];
    }
}
