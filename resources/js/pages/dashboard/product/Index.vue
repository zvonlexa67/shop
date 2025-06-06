<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import List from './List.vue'
import Create from './Create.vue'
import Edit from './Edit.vue'

import UpSert from './Update.vue'
import { useForm, router } from '@inertiajs/vue3'
import { toRaw, toRef, ref, provide, onUpdated, onMounted, inject } from 'vue'

import type { Category, Characteristic } from '@/types'
import type { Product } from '@/types/product'


interface Props {
  products: Product[] | null
  product: Product | null
  categories: Category[]
  characteristics: Characteristic[]
}

interface StrictFormData extends Product {
	_method: string
}

type FormDataType = StrictFormData & Record<string, any>
type ComponentKey = 'List' | 'Create' | 'Edit' | 'UpSert'

const props = withDefaults(defineProps<Props>(), {
  products: () => [],
  product: null,
})

const products = toRef(props.products)
const product = toRef(props.product)
const categories = toRef(props.categories)
const characteristics = toRef(props.characteristics)

const isComponent = ref<ComponentKey>('List')
const tagComponetns = { List, Create, Edit, UpSert }

const form = useForm<FormDataType>({
  id: 0,
  pivot_id: 0,
  active: true,
  title: '',
  tooltip: '',
  sort: 100,
  slug: '',
  categories: [],
  description: '',
  picture_image: [],
  characteristics: [],
  // image: null,
  // base: null,
  // nds: null,
  // purchase: null,
  // price_nds: null,
  _method: 'POST'
})


// console.log(props.characteristics)


////////////////product/////////////////////////////////

const changeForm = () => {
  form.id = 0
  form.active = true
  form.sort = 100
  form.title = ''
  form.tooltip = ''
  form.slug = ''
  form.description = ''
  form.picture_image = []

}

const resetProduct = () => {
  form.id = 0
  form.active = true
  form.sort = 100
  form.title = ''
  form.slug = ''
  form.description = ''
  form.picture_image = []
  form.image = null

}

const rollbackProduct = () => {
  if (product.value !== null) {
    form.id = product.value.id
    form.active = product.value.active
    form.sort = product.value.sort
    form.title = product.value.title
    form.tooltip = product.value.tooltip
    form.slug = product.value.slug
    form.categories = product.value.categories
    form.description = product.value.description ?? ''
    form.picture_image = product.value.picture_image
    form.characteristics = characteristics.value
    form.image = null
  }

}

const toTableProducts = () => {
  // onNodeSelected()
  // changeForm()
  // isComponent.value = 'Table'
}

//////////////////////////////Product/////////////////////////////
const loadProduct  = (id: number) => {
  router.visit(route('dashboard.product.index', { product_id: id }), 
    {
      method: 'get',
      only: [ 'product', 'characteristics' ],
    }
  )
}

const storeProduct = () => {
  if (form.id == 0) {
    form._method = 'POST'
    form.post(route('dashboard.product.store'),
      {
        only: [ 'errors', 'product', 'products' ],
        onSuccess: () => {
          product.value = props.product
          products.value = props.products
          rollbackProduct()
          isComponent.value = 'Edit'
        }
      }
    )
  }
}

const updateProduct = () => {
  if (form.id > 0) {
    form._method = 'PUT'

    // console.log(form)


    form.post(route('dashboard.product.update'),
      {
        only: [ 'errors', 'product' ],
        onSuccess: () => {
          product.value = props.product
          rollbackProduct()
        }
      }
    )
  }
}

const reloadProduct = (state = true, product_id = 0) => {
  // router.visit(
  //   route('dashboard.product.index', { category_id: category.value?.id, product_id: product_id }),
  //   {
  //     method: 'get',
  //     only: [ 'errors', 'product', 'characteristics' ],
  //     preserveState: state,
  //     preserveScroll: true,
  //     onSuccess: () => {
  //       isComponent.value = 'Table'

  //       // selectedTree.value = category.value?.id ?? 1
  //       // console.log('onSuccess')
  //       // console.log(category.value?.id)
  //       // selectedTree.value = category.value?.id ?? 0
  //       // console.log(selectedTree.value)
  //     }
  //   }
  // )
}

const destroyProduct = (product_id: number) => {
  // router.visit(
  //   route('dashboard.product.destroy', { category_id: category.value?.id, product_id: product_id }),
  //   {
  //     method: 'delete',
  //     only: [ 'errors', 'category', 'product' ],
  //     preserveState: false,
  //     preserveScroll: true,
  //     onSuccess: () => {
  //       selectedTree.value = category.value?.id ?? 0
  //     }
  //   }
  // )
}

///////////////////images/////////////////////////////////

const storeImage = () => {
  form._method = 'PUT'
  form.post(route('dashboard.product.store.image'),
    {
      only: [ 'errors', 'product' ],
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        product.value = props.product
        rollbackProduct()
      }
    }
  )
}

const storeSortImage = () => {
  form._method = 'PUT'
  form.post(route('dashboard.product.store.sort.image'),
    {
      only: [ 'error', 'product' ],
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        product.value = props.product
        rollbackProduct()
      }
    }
  )
}

const destroyImage = () => {
  form.delete(route('dashboard.product.destroy.image'),
    {
      only: ['errors', 'product'],
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        product.value = props.product
        rollbackProduct()
      }
    }
  )
}

///////////////////category/////////////////////////////////

const syncCategories = () => {
  form._method = 'PUT'
  form.post(route('dashboard.product.sync.categories'),
    {
      only: [ 'error', 'product' ],
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        product.value = props.product
        rollbackProduct()
      }
    }
  )
}

///////////////////description//////////////////////////////////

const storeDescription = () => {
  form._method = 'PUT'
  form.post(route('dashboard.product.store.description'),
  {
    only: ['errors', 'product'],
    onSuccess: () => {
      product.value = props.product
      rollbackProduct()
    }
  })
}

///////////////////characteristic//////////////////////////////////

const charDimensionOptions = ref([])
const charColorOptions = ref([])
const charBrandOptions = ref([])

const storeCharacteristics = () => {

    form.characteristics = characteristics.value

    form._method = 'PUT'

    form.put(route('dashboard.product.store.characteristics'), {
      only: [ 'errors', 'characteristics' ],
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        product.value = props.product
        rollbackProduct()
      }
    })

}

const loadCharDimentionOptions = async () => {
  if (charDimensionOptions.value.length == 0) {
    try {
    } catch(error) {
      console.log(error)
    }
  }
}

const loadCharBrandOptions = async () => {
  if (charBrandOptions.value.length == 0) {
    try {
      // const { data } = await axios.get(route('dashboard.api.brand.options'))

      // charBrandOptions.value = data
    } catch (error) {
      console.log(error)
    }
  }
}

/////////////////////Price//////////////////////////

const storePrice = () => {
  console.log('storePrice')
  form._method = 'PUT'

  form.post(route('dashboard.product.store.price'),{
    onSuccess: () => {
      rollbackProduct()
    }
  })
}

/////////////////////////////////////////////////////////

onUpdated(() => {
})

onMounted(() => {
  // console.log('onMounted')

  if (props.product) {
    rollbackProduct()
    isComponent.value = 'Edit'
  } 
  
})

provide('list', { products, isComponent, loadProduct })
provide('create', { form, isComponent, storeProduct })
provide('update', { form, isComponent, updateProduct })

provide('table', { reloadProduct, isComponent, destroyProduct })
provide('edit', { form })

provide('images', { form, storeImage, destroyImage, storeSortImage })
provide('category', { form, categories, syncCategories })
provide('description', { form, storeDescription })

provide('characteristics', { form, product, characteristics, storeCharacteristics })

provide('price', { form, storePrice, reloadProduct })

provide('dimension', { charDimensionOptions, loadCharDimentionOptions })
// provide('color', { charColorOptions, loadCharColorOptions })
provide('brand', { charBrandOptions, loadCharBrandOptions })

</script>

<template>
  <DashboardLayout>
    <component :is="tagComponetns[isComponent]" />
  </DashboardLayout>
</template>

