import { Notify } from 'quasar'

interface TypePropsNotify {
    (
        message: string,
        type: string,
        position:
            | "top-left"
            | "top-right"
            | "bottom-left"
            | "bottom-right"
            | "top"
            | "bottom"
            | "left"
            | "right"
            | "center",
    ): void;
}

export const Warning = (message: string) => ExecNT(message, 'warning', 'top')

export const Positive = (message: string) => ExecNT(message, 'positive', 'top')

export const Negative = (message: string) => ExecNT(message, 'negative', 'top')

export const Info = (message: string) => ExecNT(message, 'info', 'top')

export const Ongoing = (message: string) => ExecNT(message, 'ongoing', 'top')

const ExecNT: TypePropsNotify = (message, type, position) => Notify.create({
    message: message,
    type: type,
    position: position,
})
