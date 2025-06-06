import { PageProps as InertiaPageProps } from '@inertiajs/core'

declare module '@inertiajs/core' {
  export interface PageProps extends InertiaPageProps {
    auth: {
      user: {
        id: number
        name: string
        email: string
        [key: string]: any
        // другие поля пользователя
      }
    }
    ziggy: {
        [x: string]: any
        uri: string
        location: string
    }
  }
}





// import { PageProps } from '@inertiajs/core'

// declare module '@inertiajs/core' {
//   interface PageProps {
//     auth: {
//       user: {
//         id: number
//         name: string
//         email: string
//         // добавьте другие поля вашего пользователя
//       }
//     }
//     // другие глобальные props, если есть
//   }
// }

// declare module '@vue/runtime-core' {
//   interface ComponentCustomProperties {
//     $page: {
//       props: PageProps
//     }
//   }
// }






// import { PageProps as InertiaPageProps } from '@inertiajs/inertia';

// interface AuthUser {
//   id: number;
//   name: string;
//   email: string;
//   // добавь, что нужно
// }

// declare module '@inertiajs/inertia' {
//   interface PageProps extends InertiaPageProps {
//     auth: {
//       user: AuthUser;
//     };
//     // добавляй свои props сюда
//   }
// }






// import { PageProps } from '@inertiajs/core'

// interface User {
//   id: number
//   name: string
//   email: string
//   // добавьте другие поля пользователя
// }

// interface PagePropsWithAuth extends PageProps {
//   auth: {
//     user: User
//   }
// }
