import { CanActivate, Router } from "@angular/router";
import { Injectable } from '@angular/core';

@Injectable()
export class AuthGuardService implements CanActivate {
    constructor(
        public router: Router) {}

    canActivate(): boolean {
        if (!localStorage.getItem('token')) {
            localStorage.clear();
            this.router.navigate(['login']);
            return false;
        }
        return true;
    }
}
