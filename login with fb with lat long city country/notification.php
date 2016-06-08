$response = $this->facebook->api( '/' . $user_id . '/notifications', 'POST', array(
    'template' => 'You have received a new message.',
    'href' => 'path/to/message/?id=' . $id,
    'access_token' => $app_access_token
) );