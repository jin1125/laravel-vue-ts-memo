export type Memos = {
  id: number | undefined
  title: string
  status: 'incomplete' | 'working' | 'complete'
  detail: string
  limit: string
}