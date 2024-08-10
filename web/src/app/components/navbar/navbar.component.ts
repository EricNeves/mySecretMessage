import { Component, EventEmitter, OnInit, Output } from '@angular/core';

import { MenuItem } from 'primeng/api';
import { MenubarModule } from 'primeng/menubar';
import { StorageService } from '@services/storage.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [MenubarModule],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css',
})
export class NavbarComponent implements OnInit {
  @Output() changeDisplayInfoDev = new EventEmitter<boolean>();
  @Output() changeDisplayEditUser = new EventEmitter<boolean>();

  displayInfoDev: boolean = false;
  menu!: MenuItem[];

  constructor(private storage: StorageService, private router: Router) {}

  ngOnInit(): void {
    this.menu = [
      {
        label: 'Home',
        icon: 'pi pi-home',
      },
      {
        label: 'Profile',
        icon: 'pi pi-user',
        items: [
          {
            label: 'Edit',
            icon: 'pi pi-cog',
            command: () => {
              this.displayInfoDev = !this.displayInfoDev;
              this.changeDisplayEditUser.emit(this.displayInfoDev);
            },
          },
        ],
      },
      {
        label: 'Dev',
        icon: 'pi pi-code',
        command: () => {
          this.displayInfoDev = !this.displayInfoDev;
          this.changeDisplayInfoDev.emit(this.displayInfoDev);
        },
      },
      {
        label: 'Logout',
        icon: 'pi pi-power-off',
        command: () => {
          this.storage.clear();
          this.router.navigate(['/']);
        },
      },
    ];
  }
}
