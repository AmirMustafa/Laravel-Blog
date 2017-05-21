<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMessage;

use App\Events\MessageSent;		//we are using events for sending mails(used in line 38)
use Illuminate\Support\Facades\Event;		  //using Event Facade
use Illuminate\Support\Facades\Response;      //This facade is used for handeling AJAX Response



class ContactMessageController extends Controller {

	public function getContactIndex() {
			//Fetch Posts and Paginate

		return view('frontend.other.contact');
	}

	public function postSendMessage(Request $request) {
		$this->validate($request, [
			'email' => 'required | email',
			'name' => 'required | max:100',
			'subject' => 'required | max:140',
			'message' => 'required | min:10'
		]);

		$message = new ContactMessage();	//creating message object (we have included top: line6)

		$message->email = $request['email'];
		$message->sender = $request['name'];//sender is the name of the field in db as defined in 										migration
		$message->subject = $request['subject'];
		$message->body = $request['message'];//body is the name of the field in db as defined in 										migration
		$message->save();

		//Firing the Mail below

		Event::fire(new MessageSent($message));		//Firing the event where we have written mails (in event and listeners folder)

		return redirect()->route('contact')->with(['success' => 'Message successfully sent!']);


	}

	public function getContactMessageIndex() {
		$contact_messages = ContactMessage::orderBy('created_at', 'desc')->paginate(5);
		return view('admin.other.contact_messages', ['contact_messages' => $contact_messages]);
	}

	public function getDeleteMessage($message_id) {
		$contact_message = ContactMessage::find($message_id);
		$contact_message->delete();
		return Response::json(['message' => 'Category deleted'], 200);
	}
}
