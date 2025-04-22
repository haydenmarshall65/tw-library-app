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
    checked_out_by: CheckedOutBy | null 
    is_checked_out: boolean
    filter_on: boolean
    has_reviews: boolean
    average_rating: number
}

const isBook = (value: any): value is Book => {
    return value.title !== undefined && value.author !== undefined && value.description !== undefined
}

type User = {
    id: number
    name: string
    email: string
}

type CheckedOutBy = {
    id: number
    customer_id: number
    customer: User | null
    book_id: number
    book: Book | null
}

type CustomerReview = {
    id: number
    customer_id: number
    customer: User | null
    book_id: number
    book: Book | null
    review: string
    rating: number
}

type Filter = {name: string, on: boolean}

type BookForm = Book & {new_cover_image: File[]}

export {
    getRandomNum,
    isBook,
    type Book,
    type Filter,
    type User,
    type CheckedOutBy,
    type CustomerReview,
    type BookForm,
}