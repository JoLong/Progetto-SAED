import {Component, OnInit} from '@angular/core';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {RoomService} from '../room.service';

@Component({
    selector: 'app-updateroom',
    templateUrl: './updateroom.component.html',
    styleUrls: ['./updateroom.component.css']
})
export class UpdateRoomComponent implements OnInit {

    updateForm: FormGroup;
    roomname: FormControl;
    roomprice: FormControl;
    roompersons: FormControl;
    roomtype: FormControl;
    id: string;

    public success;

    constructor(private roomService: RoomService,
                private route: Router) {
    }

    createUpdateFormControls() {

        this.roomname = new FormControl('', Validators.required);
        this.roomprice = new FormControl('', Validators.required);
        this.roompersons = new FormControl('', Validators.required);
        this.roomtype = new FormControl('', Validators.required);
    }

    createUpdateForm() {

        this.updateForm = new FormGroup({
            roomname: this.roomname,
            roomprice: this.roomprice,
            roompersons: this.roompersons,
            roomtype: this.roomtype,
        });
    }

    ngOnInit() {
        this.createUpdateFormControls();
        this.createUpdateForm();
    }

    onSubmit() {

        if (this.updateForm.valid) {

            this.id = localStorage.getItem('roomId');
            console.log('Form Submitted!');

            this.success = this.roomService.updateRoom(
                this.id,
                this.updateForm.value.roomname,
                this.updateForm.value.roomprice,
                this.updateForm.value.roompersons,
                this.updateForm.value.roomtype
            )
                .subscribe(
                    room => {

                        if (room.message === 'Room updated') {

                            alert('Room update done successfully');
                            this.updateForm.reset();
                            this.route.navigate(['home']);
                        } else {

                            alert('Room prenotation not done');
                        }
                    },
                    error => console.log(error)
                );
        } else {
            console.log('Form not valid');
        }
    }

}
