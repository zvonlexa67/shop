import type { KeySessionStoreType } from '@/types'
import { SessionStorage } from 'quasar'
import { Ref } from 'vue'

export const WSSR = {
    load: (key: Ref<KeySessionStoreType>): any | null => {
        if( SessionStorage.has(key.value)) {
            return SessionStorage.getItem(key.value)
        }

        return null
    },

    write: (key: Ref<KeySessionStoreType>, value: any): void => {
        SessionStorage.removeItem(key.value)
        SessionStorage.setItem(key.value, value)
    },

    remove: (key: Ref<KeySessionStoreType>): void => SessionStorage.removeItem(key.value),

    has: (key: Ref<KeySessionStoreType>): boolean => SessionStorage.has(key.value),
}

// export const WSS = {
//     load: (key: KeySessionStoreType): any | null => {
//         if( SessionStorage.has(key)) {
//             return SessionStorage.getItem(key)
//         }

//         return null
//     },

//     write: (key: KeySessionStoreType, value: any): void => {
//         SessionStorage.removeItem(key)
//         SessionStorage.setItem(key, value)
//     },

//     remove: (key: KeySessionStoreType): void => SessionStorage.removeItem(key),

//     has: (key: KeySessionStoreType): boolean => SessionStorage.has(key),
// }
