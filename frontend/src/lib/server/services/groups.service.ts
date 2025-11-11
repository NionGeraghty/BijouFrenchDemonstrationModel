import { LARAVEL_API_BASE } from '$env/static/private';
import type { Group, Course } from '$lib/types';
import APIService from './api.service';

export class GroupsServices extends APIService {
  constructor() {
    super(LARAVEL_API_BASE || 'http://localhost:8000/api');
  }

  async getGroups(): Promise<Group[]> {
    return this.get('/groups')
      .then((res) => res?.data?.data || [])
      .catch((err) => {
        throw err?.response?.data;
      });
  }

  async createGroup(input: CreateGroupInput): Promise<Group> {
    return this.post('/groups', input)
      .then((res) => res?.data?.data || [])
      .catch((err) => {
        throw err?.response?.data;
      });
  }

  async activateGroup(groupId: number): Promise<Group> {
    return this.patch(`/groups/${groupId}`, { active: true })
      .then((res) => res?.data?.data || [])
      .catch((err) => {
        throw err?.response?.data;
      });
  }

  async deactivateGroup(groupId: number): Promise<Group> {
    return this.patch(`/groups/${groupId}`, { active: false })
      .then((res) => res?.data?.data || [])
      .catch((err) => {
        throw err?.response?.data;
      });
  }

  async increaseOrder(groupId: number): Promise<Group> {
    return this.patch(`/groups/${groupId}/move`, { direction: 'down' })
      .then((res) => res?.data?.data || [])
      .catch((err) => {
        throw err?.response?.data;
      });
  }

  async decreaseOrder(groupId: number): Promise<Group> {
    return this.patch(`/groups/${groupId}/move`, { direction: 'up' })
      .then((res) => res?.data?.data || [])
      .catch((err) => {
        throw err?.response?.data;
      });
  }

  async getActiveCourseBySlud(slug: string): Promise<Course> {
    return this.get(`/groups/${slug}/course`)
      .then((res) => res?.data?.data || {})
      .catch((err) => {
        throw err?.response?.data;
      });
  }
}

type CreateGroupInput = {
  title: string;
};

