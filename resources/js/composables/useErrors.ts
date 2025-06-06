import { Negative } from './useNotify'

export const Errors = (errors: object) => Object.keys(errors).forEach(key => Negative(`${errors[key as keyof typeof errors]}`))
// export const Errors = (errors: object) => Object.keys(errors).forEach(key => Negative(`Ключ: ${key}, Значение: ${errors[key as keyof typeof errors]}`))
