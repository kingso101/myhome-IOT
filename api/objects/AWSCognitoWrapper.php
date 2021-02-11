<?php
namespace AWSCognitoApp;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
putenv('CLIENT_ID=73nkbeiki4s2q5c2v9v8ek4aue');
putenv('USERPOOL_ID=us-east-1_yXMlljTfq');
putenv('AWS_ACCESS_KEY_ID=AKIATBV3IPRIOGEBEMYR');
putenv('AWS_SECRET_ACCESS_KEY=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');
putenv('REGION=us-east-1');
putenv('VERSION=latest');

class AWSCognitoWrapper
{
    private const COOKIE_NAME = 'aws-cognito-app-access-token';

    private $region;
    private $client_id;
    private $userpool_id;

    private $client;

    private $user = null;

    public function __construct()
    {
        if(!getenv('REGION') || !getenv('CLIENT_ID') || !getenv('USERPOOL_ID')) {
            throw new \InvalidArgumentException("Please provide the region, client_id and userpool_id variables in the .env file");
        }

        $this->region = getenv('REGION');
        $this->client_id = getenv('CLIENT_ID');
        $this->userpool_id = getenv('USERPOOL_ID');
    }

    public function initialize() : void
    {
        $this->client = new CognitoIdentityProviderClient([
          'version' => getenv('VERSION'),
          'region' => $this->region,
        ]);

        try {
            $this->user = $this->client->getUser([
                'AccessToken' => $this->getAuthenticationCookie()
            ]);
        } catch(\Exception  $e) {
            // an exception indicates the accesstoken is incorrect - $this->user will still be null
        }
    }

    public function authenticate(string $username, string $password) : string
    {
        try {
            $result = $this->client->adminInitiateAuth([
                'AuthFlow' => 'ADMIN_NO_SRP_AUTH',
                'ClientId' => $this->client_id,
                'UserPoolId' => $this->userpool_id,
                'AuthParameters' => [
                    'USERNAME' => $username,
                    'PASSWORD' => $password,
                ],
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $this->setAuthenticationCookie($result->get('AuthenticationResult')['AccessToken']);

        return '';
    }

    public function signup(string $username, string $email, string $password) : string
    {
        try {
            $result = $this->client->signUp([
                'ClientId' => $this->client_id,
                'Username' => $username,
                'Password' => $password,
                'UserAttributes' => [
                    [
                        'Name' => 'name',
                        'Value' => $username
                    ],
                    [
                        'Name' => 'email',
                        'Value' => $email
                    ]
                ],
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return '';
    }

    public function confirmSignup(string $username, string $code) : string
    {
        try {
            $result = $this->client->confirmSignUp([
                'ClientId' => $this->client_id,
                'Username' => $username,
                'ConfirmationCode' => $code,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return '';
    }

    public function sendPasswordResetMail(string $username) : string
    {
        try {
            $this->client->forgotPassword([
                'ClientId' => $this->client_id,
                'Username' => $username
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return '';
    }

    public function resetPassword(string $code, string $password, string $username) : string
    {
        try {
            $this->client->confirmForgotPassword([
                'ClientId' => $this->client_id,
                'ConfirmationCode' => $code,
                'Password' => $password,
                'Username' => $username
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return '';
    }

    public function isAuthenticated() : bool
    {
        return null !== $this->user;
    }

    public function getPoolMetadata() : array
    {
        $result = $this->client->describeUserPool([
            'UserPoolId' => $this->userpool_id,
        ]);

        return $result->get('UserPool');
    }

    public function getPoolUsers() : array
    {
        $result = $this->client->listUsers([
            'UserPoolId' => $this->userpool_id,
        ]);

        return $result->get('Users');
    }

    public function getUser() : ?\Aws\Result
    {
        return $this->user;
    }

    public function logout()
    {
        if(isset($_COOKIE[self::COOKIE_NAME])) {
            unset($_COOKIE[self::COOKIE_NAME]);
            setcookie(self::COOKIE_NAME, '', time() - 3600);
        }
    }

    private function setAuthenticationCookie(string $accessToken) : void
    {
        /*
         * Please note that plain-text storage of the access token is insecure and
         * not recommended by AWS. This is only done to keep this example
         * application as easy as possible. Read the AWS docs for more info:
         * http://docs.aws.amazon.com/cognito/latest/developerguide/amazon-cognito-user-pools-using-tokens-with-identity-providers.html
        */
        setcookie(self::COOKIE_NAME, $accessToken, time() + 3600);
    }

    private function getAuthenticationCookie() : string
    {
        return $_COOKIE[self::COOKIE_NAME] ?? '';
    }
}
