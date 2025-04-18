const getRandomNum = (min: number, max: number) => {
    return Math.floor(Math.random() * (max - min) + min);
}

type Book = {
    id: number
    title: string
    author: string
    description: string
    cover_image: string | null
    publisher: string
    publication_date: string
    category: string
    isbn: string
    page_count: number
    checked_out_by: []
    filter_on: boolean
}

const isBook = (value: any): value is Book => {
    return value.title !== undefined && value.author !== undefined && value.description !== undefined
}

type Filter = {name: string, on: boolean}

export {
    getRandomNum,
    isBook,
    type Book,
    type Filter,
}