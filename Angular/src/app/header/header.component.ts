import {Component, OnInit} from '@angular/core';
import {GlobalsService} from '../globals.service';
import {Router} from '@angular/router';

@Component({
    selector: 'app-header',
    templateUrl: './header.component.html',
    styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

    public localStorage;

    constructor(public router: Router,
                public globals: GlobalsService) {
        this.localStorage = localStorage;
    }

    ngOnInit() {

    }

    logout() {
        localStorage.clear();
        this.router.navigate(['login']);
    }
}
