<?php

namespace Seblhaire\Specialauth;

trait RedirectsUsers {

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    protected $redirectLogout;

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath() {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    public function redirectLogoutPath() {
        if (method_exists($this, 'redirectLogout')) {
            return $this->redirectLogout();
        }

        return property_exists($this, 'redirectLogout') ? $this->redirectLogout : '/home';
    }
}
