import {Component, OnInit, Pipe} from '@angular/core';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import {AuthService} from '../auth.service';
import {Router} from '@angular/router';

@Component({
    selector: 'app-registration',
    templateUrl: './registration.component.html',
    styleUrls: ['./registration.component.css'],

    providers: [AuthService]

})


export class RegistrationComponent implements OnInit {

    registrationForm: FormGroup;
    username: FormControl;
    email: FormControl;
    psw: FormControl;
    adminUser: FormControl;

    success;

    constructor(private authService: AuthService,
                private route: Router) {
    }

    createFormControls() {

        this.username = new FormControl('', Validators.required);
        this.email = new FormControl('', Validators.required);
        this.psw = new FormControl('', Validators.required);
        this.adminUser = new FormControl('', Validators.required);
    }

    createForm() {

        this.registrationForm = new FormGroup({
            username: this.username,
            email: this.email,
            psw: this.psw,
            adminUser: this.adminUser,
        });
    }

    ngOnInit() {
        this.createFormControls();
        this.createForm();
    }

    onSubmit() {

        if (this.registrationForm.valid) {

            this.success = this.authService.registrationAuthentication(this.registrationForm.value)
                .subscribe(
                    user => {

                        if (user.message === 'User created.') {

                            alert('User registered successfully');
                            this.route.navigate(['home']);

                        } else {

                            alert('User not registered');

                        }

                    },
                    error => console.log(error)
                );

        } else {
            console.log('Form not valid');
        }
    }

}
