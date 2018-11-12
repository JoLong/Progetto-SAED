import {Component, OnInit} from '@angular/core';
import {RoomService} from '../room.service';
import {Router} from '@angular/router';
import {Room} from '../../Room';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.css']
})

export class HomeComponent implements OnInit {

    public localStorage;
    private calendarList = false;
    private prenotationStatus = false;
    private undoPrenotationStatus = false;
    private roomId;
    private roomType;

    prenotationForm: FormGroup;
    undoPrenotationForm: FormGroup;
    pickerFrom: FormControl;
    pickerTo: FormControl;
    undoYesOrNot: FormControl;

    public success;
    rooms: Room[];


    constructor(private roomService: RoomService,
                private route: Router) {
        this.localStorage = localStorage;
    }

    createFormControls() {

        this.pickerFrom = new FormControl('', Validators.required);
        this.pickerTo = new FormControl('', Validators.required);
    }

    createForm() {

        this.prenotationForm = new FormGroup({
            pickerFrom: this.pickerFrom,
            pickerTo: this.pickerTo
        });
    }

    createUndoFormControls() {

        this.undoYesOrNot = new FormControl('', Validators.required);
    }

    createUndoForm() {

        this.undoPrenotationForm = new FormGroup({
            undoYesOrNot: this.undoYesOrNot
        });
    }

    ngOnInit() {
        this.createFormControls();
        this.createForm();
        this.createUndoFormControls();
        this.createUndoForm();
    }

    roomSearch(roomType) {
        this.calendarList = true;
        this.roomType = roomType;
        this.search(roomType);
    }

    search(roomType) {

        this.success = this.roomService.readRooms(roomType)
            .subscribe(
                rooms => {
                    this.rooms = rooms['records'];
                },
                error => console.log(error)
            );
    }

    prenotation(id) {
        this.roomId = id;
        this.calendarList = false;
        this.prenotationStatus = true;
    }

    undoPrenotation(id) {
        this.roomId = id;
        this.calendarList = false;
        this.undoPrenotationStatus = true;
    }

    updateRoom(id) {

        localStorage.setItem('roomId', id);
        this.route.navigate(['updateroom']);
    }

    deleteRoom(id) {
        this.success = this.roomService.deleteRoom(id)
            .subscribe(
                room => {

                    if (room.message === 'Room deleted') {

                        alert('Room deleted successfully');
                        this.route.navigate(['home']);
                        this.search(this.roomType);

                    } else {

                        alert('Delete not done');
                    }
                },
                error => console.log(error)
            );
        this.calendarList = true;
        this.prenotationStatus = false;
        this.undoPrenotationStatus = false;
        this.prenotationForm.reset();
        this.undoPrenotationForm.reset();
    }

    createRoom() {
        this.route.navigate(['createroom']);
    }

    onSubmit() {

        if (this.prenotationForm.valid) {

            console.log('Form Submitted!');

            this.success = this.roomService.prenotationRoom(this.roomId,
                this.prenotationForm.value.pickerFrom,
                this.prenotationForm.value.pickerTo)
                .subscribe(
                    room => {

                        if (room.message === 'Room prenotated') {

                            alert('Room prenotation done successfully');
                            this.route.navigate(['home']);
                            this.search(this.roomType);

                        } else {

                            alert('Room prenotation not done');
                        }
                    },
                    error => console.log(error)
                );
        } else {
            console.log('Form not valid');
        }

        if (this.undoPrenotationForm.valid && this.undoPrenotationForm.value.undoYesOrNot === '1'
        ) {
            this.success = this.roomService.undoPrenotationRoom(this.roomId)
                .subscribe(
                    room => {

                        if (room.message === 'Room unprenotated') {

                            alert('Undo prenotation done successfully');
                            this.route.navigate(['home']);
                            this.search(this.roomType);

                        } else {

                            alert('Undo prenotation not done');
                        }
                    },
                    error => console.log(error)
                );
        }
        this.calendarList = true;
        this.prenotationStatus = false;
        this.undoPrenotationStatus = false;
        this.prenotationForm.reset();
        this.undoPrenotationForm.reset();
    }
}
