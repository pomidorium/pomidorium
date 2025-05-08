export interface Project {
    // columns
    id: number;
    title: string;
    description?: string | null;
    owner_id: number;
    created_at?: string | null;
    updated_at?: string | null;
    deleted_at?: string | null;
    // relations
    owner: User;
    media: Medium[];
}

export interface User {
    // columns
    id: number;
    name: string;
    email: string;
    // mutators
    avatar: string;
    // relations
    projects: Project[];
    roles: Role[];
    permissions: Permission[];
    media: Medium[];
    notifications: DatabaseNotification[];
}
