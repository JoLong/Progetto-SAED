import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {GlobalsService} from './globals.service';

@NgModule({
    imports: [
        CommonModule,
    ],
    providers: [
        GlobalsService
    ],
    exports: [
        CommonModule,
        FormsModule,
        ReactiveFormsModule
    ]
})
export class SharedModule {
}