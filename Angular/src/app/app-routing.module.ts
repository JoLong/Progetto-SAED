import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {HomeComponent} from './home/home.component';
import {LoginComponent} from './login/login.component';
import {CreateRoomComponent} from './createroom/createroom.component';
import {UpdateRoomComponent} from './updateroom/updateroom.component';
import {RegistrationComponent} from './registration/registration.component';
import {TestComponent} from './test/test.component';
import {LoginGuardService} from './can-activate/login.guard';
import {AuthGuardService} from './can-activate/auth.guard';

const routes: Routes = [
    {
        path: '', redirectTo: 'home', pathMatch: 'full'
    },
    {
        path: 'home', component: HomeComponent,
        canActivate: [AuthGuardService]
    },
    {
        path: 'login', component: LoginComponent,
        canActivate: [LoginGuardService]
    },
    {
        path: 'registration', component: RegistrationComponent
    },
    {
        path: 'test', component: TestComponent
    },
    {
        path: 'updateroom', component: UpdateRoomComponent
    },
    {
        path: 'createroom', component: CreateRoomComponent
    }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
