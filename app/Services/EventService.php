<?php

namespace App\Services;


use App\Repositories\EventRepository;
use App\Traits\FileUploadable;

class EventService extends BaseService
{
    use FileUploadable;

    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        parent::__construct($eventRepository);
        $this->eventRepository = $eventRepository;
    }

    public function create(array $data)
    {
        if (isset($data['photo'])) {
            $data['photo'] = $this->uploadFile($data['photo'], 'events');
        }

        return $this->eventRepository->create($data);
    }

    public function update(string $id,array $data)
    {
        if (isset($data['photo'])){
            $event = $this->find($id);
            /*if ($event && $event->photo){
                $this->replaceFile($data['photo'],'events',$event->photo ?? '');
            }else{
                $this->uploadFile($data['photo'],'events');
            }*/
            $this->replaceFile($data['photo'],'events',$event->photo ?? '');

        }
        $this->eventRepository->update($id,$data);
    }
    public function delete(string $id) : bool
    {
        $event = $this->find($id);
        if ($event && $event->photo){
            $this->deleteFile($event->photo);
        }
     return $this->eventRepository->delete($id);
    }

}
