import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';

import {map} from 'rxjs/operators';

@Injectable({
    providedIn: 'root'
})
export class RoomService {

    constructor(private _http: HttpClient) {

    }

    readRooms(type) {
        return this._http
            .get('http://affittacamere.com/products/readRooms.php?type=' + type)
            .pipe(map((res: any) => res));
    }

    prenotationRoom(roomId, fromDate, toDate) {
        return this._http
            .get('http://affittacamere.com/products/prenotateRoom.php?id=' + roomId
                + '&occuped_from=' + fromDate + '&occuped_to=' + toDate)
            .pipe(map((res: any) => res));
    }

    undoPrenotationRoom(roomId) {
        return this._http
            .get('http://affittacamere.com/products/undoPrenotationRoom.php?id=' + roomId)
            .pipe(map((res: any) => res));
    }

    deleteRoom(roomId) {
        return this._http
            .get('http://affittacamere.com/products/delete.php?id=' + roomId)
            .pipe(map((res: any) => res));
    }

    updateRoom(roomId, roomName, roomPrice, roomPersons, roomType) {
        return this._http
            .get('http://affittacamere.com/products/update.php?id=' + roomId + '&name=' + roomName +
                '&price=' + roomPrice + '&persons=' + roomPersons + '&type=' + roomType)
            .pipe(map((res: any) => res));
    }

    createRoom(room) {
        return this._http.post(
            'http://affittacamere.com/products/create.php',
            room
        ).pipe(map((res: any) => res));
    }

}
