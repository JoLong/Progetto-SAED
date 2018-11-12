import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {RoomService} from '../room.service';

@Component({
    selector: 'app-createroom',
    templateUrl: './createroom.component.html',
    styleUrls: ['./createroom.component.css']
})
export class CreateRoomComponent implements OnInit {

    creationRoomForm: FormGroup;
    roomName: FormControl;
    roomPrice: FormControl;
    roomPersons: FormControl;
    roomType: FormControl;

    success;

    constructor(private roomService: RoomService,
                private route: Router) {
    }

    createFormControls() {

        this.roomName = new FormControl('', Validators.required);
        this.roomPrice = new FormControl('', Validators.required);
        this.roomPersons = new FormControl('', Validators.required);
        this.roomType = new FormControl('', Validators.required);
    }

    createForm() {

        this.creationRoomForm = new FormGroup({
            roomName: this.roomName,
            roomPrice: this.roomPrice,
            roomPersons: this.roomPersons,
            roomType: this.roomType,
        });
    }

    ngOnInit() {
        this.createFormControls();
        this.createForm();
    }

    onSubmit() {

        if (this.creationRoomForm.valid) {

            this.success = this.roomService.createRoom(this.creationRoomForm.value)
                .subscribe(
                    room => {

                        if (room.message === 'Room created') {

                            alert('Room registered successfully');
                            this.creationRoomForm.reset();
                            this.route.navigate(['home']);

                        } else {

                            alert('Room not created');

                        }

                    },
                    error => console.log(error)
                );

        } else {
            console.log('Form not valid');
        }
    }

}
