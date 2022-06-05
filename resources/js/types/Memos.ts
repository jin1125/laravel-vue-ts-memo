export type Memos = {
  id: number
  title: string
  status: 'incomplete' | 'working' | 'complete'
  detail: string
  limit: string
  created_at: string
  updated_at: string
  user_id: number
}