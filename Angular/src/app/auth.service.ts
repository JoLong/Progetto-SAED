import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';

import {map} from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class AuthService {

    constructor(private _http: HttpClient) {

    }
    loginAuthentication(username, psw) {

        return this._http
            .get('http://affittacamere.com/users/login.php?username=' + username + '&password=' + psw)
            .pipe(map((res: any) => res));
    }

    registrationAuthentication(user) {

        // let headers = new Headers({ 'Content-Type': 'application/json' });
        // let options = new RequestOptions({ headers: headers });

        return this._http.post(
            'http://affittacamere.com/users/register.php',
            user
        ).pipe(map((res: any) => res));
    }
}
