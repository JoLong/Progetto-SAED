import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {SidebarComponent} from './sidebar/sidebar.component';

import {HttpClientModule} from '@angular/common/http';
import {HeaderComponent} from './header/header.component';
import {FooterComponent} from './footer/footer.component';
import {HomeComponent} from './home/home.component';
import {LoginComponent} from './login/login.component';
import {RegistrationComponent} from './registration/registration.component';
import {TestComponent} from './test/test.component';

import {SharedModule} from './shared.module';
import {AuthGuardService} from './can-activate/auth.guard';
import {LoginGuardService} from './can-activate/login.guard';
import {RoomService} from './room.service';

import {
    MatDatepickerModule,
    MatNativeDateModule,
    MatFormFieldModule,
    MatInputModule
} from '@angular/material';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {UpdateRoomComponent} from './updateroom/updateroom.component';
import {CreateRoomComponent} from './createroom/createroom.component';


@NgModule({
    declarations: [
        AppComponent,
        SidebarComponent,
        HeaderComponent,
        FooterComponent,
        HomeComponent,
        LoginComponent,
        RegistrationComponent,
        TestComponent,
        UpdateRoomComponent,
        CreateRoomComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        HttpClientModule,
        SharedModule,
        MatDatepickerModule,
        MatFormFieldModule,
        MatNativeDateModule,
        MatInputModule,
        BrowserAnimationsModule
    ],
    exports: [
        MatInputModule,
        BrowserAnimationsModule
    ],
    providers: [
        AuthGuardService,
        LoginGuardService,
        RoomService
    ],
    bootstrap: [
        AppComponent,
    ]
})
export class AppModule {
}
