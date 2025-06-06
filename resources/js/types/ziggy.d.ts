// import { RouteParams, Router } from 'ziggy-js';

// declare global {
//     function route(): Router;
//     function route(name: string, params?: RouteParams<typeof name> | undefined, absolute?: boolean): string;
// }

// declare module '@vue/runtime-core' {
//     interface ComponentCustomProperties {
//         route: typeof route;
//     }
// }

// declare module 'ziggy-js' {
//     import { Config } from 'ziggy';

//     type Params = Record<string, string | number | boolean>;

//     export default function route(
//       name?: string,
//       params?: Params | Params[],
//       absolute?: boolean,
//       config?: Config
//     ): string;

//     export const Ziggy: Config;
//   }
