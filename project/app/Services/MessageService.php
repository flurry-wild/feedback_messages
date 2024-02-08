<?php

namespace App\Services;

use App\Classes\Converters\ExcelConverter;
use App\Models\Message;
use App\Models\User;

class MessageService
{
    const LIMIT = 10;
    const PAGE_DEFAULT = 1;
    const ORDER_DEFAULT = 'ASC';

    public static function query()
    {
        return Message::query();
    }

    public function create(array $data)
    {
        $userWithEmail = User::where('email', $data['email']);
        if ($userWithEmail->exists()) {
            $data = array_merge($data, [
                'user_id' => $userWithEmail->first()->id,
                'registered' => true
            ]);
        }

        return Message::create($data);
    }

    public function getOne(int $messageId)
    {
        return Message::find($messageId);
    }

    public function getList(?array $params)
    {
        if (!isset($params['page'])) {
            $params['page'] = static::PAGE_DEFAULT;
        }
        if (!isset($params['order'])) {
            $params['order'] = static::ORDER_DEFAULT;
        }

        $query = static::query();

        $query->orderBy('create_at', $params['order']);
        $query->limit(static::LIMIT);
        $query->offset(($params['page'] - 1) * static::LIMIT);

        return $query->get();
    }

    public function getCountPages()
    {
        $count = static::query()->count();
        $limit = static::LIMIT;

        return  intdiv($count, $limit) > 0 ? round($count/$limit) + 1: round($count/$limit);
    }

    public function update(int $messageId, array $params)
    {
        $message = Message::find($messageId);

        if ($message == null) {
            return $message;
        }

        return $message->update($params);
    }

    public function excelAll()
    {
        $messages = static::query()
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->get();

        (new ExcelConverter($messages))->exec();
    }
}
