export interface TreeNode {
  id: string;
  text: string;
  children?: TreeNode[];
  parentId?: string | null;
}