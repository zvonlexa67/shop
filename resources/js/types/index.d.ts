import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

// import type { QTreeNode } from 'quasar'

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number
    name: string | null
    email: string | null
    avatar?: string | null
    email_verified_at: string | null
    created_at: string | null
    updated_at: string | null
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface NavRoute {
    title: string
    uri?: string
    name: string
    icon: LucideIcon
    params?: Record<string, string | number>;
    method?: 'get' | 'post' | 'put' | 'delete'
    children: NavRoute[]
}

export interface Dimension {
    id: integer;
    sort: integer;
    title: string;
}

export interface Color {
    id: number
    sort: number
    title: string
    picture_image?: string
}

export interface Brand {
    id: number;
    title: string;
    slug: string;
    href: string;
    sort: number;
    count_products: number;
    picture_image?: string;
    description: string;
}

export interface Slide {
    id: number;
    name: string;
    sort: number;
    href: string;
    picture?: string;
}

export interface TypeEnum {
    label: string
    value: number
}

export interface Characteristic extends QTreeNode {
    id: number
    sort: number
    title: string
    smart: boolean
    type: TypeEnum | null
    description: string
    parent_id: number | null
    children: Characteristic[]
}

export interface Category {
    id: number
    parent_id: number
    sort: number
    title: string
    slug: string
    picture_image: string
    picture_icon: string
    children: Category[]
}

export interface Item {
  id: number
  title: string
}

export interface GalleryImage {
  id: number
  url: string
  // name: string
  file: File
}

export type KeySessionStoreType = 
  'keyActiveNavRoute' | 
  'keyExpSideBar' | 
  'keyZiggyAs' | 
  'keySelectSmart' |
  'keySelectCompare' |
  'keyProductisComponent'
