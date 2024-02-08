<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\MessageIndexRequest;
use App\Http\Requests\Message\MessageStoreRequest;
use App\Http\Requests\Message\MessageUpdateRequest;
use App\Services\MessageService;
use Illuminate\Http\JsonResponse;

class MessagesController extends Controller
{
    /** @var MessageService $service */
    private $service;

    public function __construct()
    {
        $this->service = app(MessageService::class);
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(MessageStoreRequest $request)
    {
        return new JsonResponse($this->service->create($request->validated()));
    }

    public function show(int $messageId)
    {
        return view('messages.show', ['message' => $this->service->getOne($messageId)]);
    }

    public function edit(int $messageId)
    {
        return view('messages.edit', ['message' => $this->service->getOne($messageId)]);
    }

    public function update(int $messageId, MessageUpdateRequest $request)
    {
        return new JsonResponse($this->service->update($messageId, $request->validated()));
    }

    public function index(MessageIndexRequest $request)
    {
        return view('messages.index', [
            'messages' => $this->service->getList($request->validated()),
            'page' => $request->page ?? MessageService::PAGE_DEFAULT,
            'countPages' => $this->service->getCountPages()
        ]);
    }

    public function excelAll()
    {
        $this->service->excelAll();
    }
}
