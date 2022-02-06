<?php

namespace App\Mail;

use App\Models\BookList;
use App\Models\FormBuilder;
use App\Models\Status;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Robiussani152\Settings\Facades\Settings;

class StatusChangeNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $book_list_id;
    public $book_info;
    public $book_content;
    public $change_data;
    public $change_by;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $book_list_id, array $change_value)
    {
        $this->book_list_id = $book_list_id;
        $this->subject('Change Book Status');
        $this->replyTo(config('mail')['from']['address'], Settings::get('title'));
        $this->from(config('mail')['from']['address'], Settings::get('title'));
        $response           = $this->getBookListInfo($book_list_id);
        $this->book_content = $response;
        $this->change_data  = $this->getChangeValue($change_value);
        $this->change_by    = auth()->user()->full_name;
        // Log::info($this->change_data);
    }

    public function getBookListInfo($bool_list_id)
    {
        try {
            $book_list = BookList::with('serise')->findOrFail($bool_list_id);

            $this->book_info = $book_list;
            $update_content  = [];
            foreach ($book_list->content as $key => $content) {
                $book_format = FormBuilder::findOrFail($key);
                if ($book_format) {
                    if ($content['type'] == '1') {
                        $getStatus                           = Status::findOrFail($content['text']);
                        $update_content[$book_format->label] = $getStatus->status;
                    } else {
                        $update_content[$book_format->label] = $content['text'];
                    }

                }
            }

            return $update_content;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function getChangeValue($change_value)
    {
        Log::info($change_value);
        try {
            $change_data = [];
            foreach ($change_value as $key => $val) {
                $book_format                      = FormBuilder::findOrFail($key);
                $getStatus                        = Status::findOrFail($val);
                $change_data[$book_format->label] = $getStatus->status;

            }
            return $change_data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.notification-email.statusChangeNotification', ['book_info' => $this->book_info, 'book_content' => $this->book_content, 'change_data' => $this->change_data, 'change_by' => $this->change_by]);
    }
}
