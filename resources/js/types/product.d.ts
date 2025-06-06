import { GalleryImage } from "."

export interface Product {
  id: number
  pivot_id: number
  active: boolean
  title: string
  tooltip: string
  sort: number
  slug: string
  categories: number[]
  description: string
  picture_image: GalleryImage[] | string[]
  
  // image: null,
  // base: null,
  // nds: null,
  // purchase: null,
  // price_nds: null,
  // _method: 'POST'
}

export interface Character {
  children: any
  field: string
  id: number
  title: string
  char: Char[]
}

export interface Char {
  field: string
  id: number
  parent_id: number
  pivot_id: number
  children: Char[]
  type: string
  title: string
  description: string
  first: FirstLastType
  last: FirstLastType
}

interface CharDimensionType {
  label: string
  value: number
}

export interface CharColorType {
  href: string
  label: string
  value: number
}

export type FirstLastType = null | number | string |boolean | CharDimensionType | CharColorType
