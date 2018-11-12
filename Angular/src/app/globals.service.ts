import { Injectable } from '@angular/core';

@Injectable()
export class GlobalsService {

  _access: any = {};

  constructor() {
      this._access.access = false;
  }

    getAccess(): boolean {
      console.log('get', this._access);
        return this._access.access;
    }

    setAccess(value: boolean) {
        this._access.access = value;
        console.log('set', this._access);
    }


}
