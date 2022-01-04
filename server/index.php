<?php
/**
 * Login system
 * 
 * @package trello-clone
 */

require_once __DIR__ . '/db/connection_configuration.php';
require_once __DIR__ . '/db/connection.php';
require_once __DIR__ . '/db/statements.php';


$action = (isset($_GET['action'])) ? $_GET['action'] : '';

switch ($action) {
    case 'login':
        # code...
        if (
            !isset( $_POST['email'] ) ||
            !isset( $_POST['password'] )
        ) {
            // bad request
            response(
                [
                    'status' => 'error',
                    'message' => 'Missing email or password'
                ],
                400
            );
        }else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = DB::login($email, $password);

            if ($user) {
                # code...
                response(
                    [
                        'status' => 'success',
                        'user' => $user
                    ],
                    200
                );
            }else {
                // invalid user
                response(
                    [
                        'status' => 'error',
                        'message' => 'Invalid email or password'
                    ],
                    403
                );
            }
        }
        break;
    case 'signup':
        
        if (
            !isset( $_POST['email'] ) ||
            !isset( $_POST['password'] ) ||
            !isset( $_POST['fullname'] )
        ) {
            // bad request
            response(
                [
                    'status' => 'error',
                    'message' => 'Missing email, password or fullname'
                ],
                400
            );
        }else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];

            $user = DB::signup($email, $password, $fullname);

            if ($user) {
                // success
                response(
                    [
                        'status' => 'success',
                        'user' => $user
                    ],
                    200
                );
            }else {
                // error
                response(
                    [
                        'status' => 'error',
                        'message' => 'Invalid email or password'
                    ],
                    403
                );
            }
        }

        break;
    default:
        # ping and create tables
        DB::createTables();

        # redirect to login
        header('Location: ?action=login');
        break;
}


function response( $payload, $code = 200 ) {
    http_response_code( $code );
    header('Content-Type: application/json');
    echo json_encode( $payload );
    exit;
}