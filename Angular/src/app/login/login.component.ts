import {Component, OnInit} from '@angular/core';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import {AuthService} from '../auth.service';
import {Router} from '@angular/router';
import {GlobalsService} from '../globals.service';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css'],

    providers: [
        AuthService,
        GlobalsService
    ]
})

export class LoginComponent implements OnInit {

    loginForm: FormGroup;
    username: FormControl;
    psw: FormControl;

    success;
    token: string;

    constructor(private authService: AuthService,
                private route: Router) {
    }

    createFormControls() {

        this.username = new FormControl('', Validators.required);
        this.psw = new FormControl('', Validators.required);
    }

    createForm() {

        this.loginForm = new FormGroup({
            username: this.username,
            psw: this.psw
        });
    }

    ngOnInit() {
        this.createFormControls();
        this.createForm();
    }

    onSubmit() {

        if (this.loginForm.valid) {
            console.log('Form Submitted!');

            this.success = this.authService.loginAuthentication(this.loginForm.value.username, this.loginForm.value.psw)
                .subscribe(
                    user => {

                        if (user.token !== null) {

                            localStorage.setItem('token', user.token);
                            localStorage.setItem('role', user.adminUser);

                            this.route.navigate(['home']);
                        } else {
                            alert('User not present');
                        }
                    },
                    error => console.log(error)
                );

            this.loginForm.reset();

        } else {
            console.log('Form not valid');
        }
    }

}
