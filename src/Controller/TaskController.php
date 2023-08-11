<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/task')]
class TaskController extends AbstractController
{
    #[Route('/', name: 'app_task_index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response
    {
       
        $tasks = $taskRepository->findAll();
    
       
        usort($tasks, function ($a, $b) {
            $statusOrder = ['A faire', 'En cours', 'Terminée'];
            return array_search($a->getStatus(), $statusOrder) - array_search($b->getStatus(), $statusOrder);
        });

        usort($tasks, function ($a, $b) {
            $statusOrder = ['A faire', 'En cours', 'Terminée'];
            $priorityOrder = ['Urgent', 'Medium', 'Low'];
    
            $statusComparison = array_search($a->getStatus(), $statusOrder) - array_search($b->getStatus(), $statusOrder);
            if ($statusComparison !== 0) {
                return $statusComparison;
            }
    
            return array_search($a->getPriority(), $priorityOrder) - array_search($b->getPriority(), $priorityOrder);
        });
    
    
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }
    #[Route('/new', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $task = new Task();
        $user = $security->getUser();
        $task->setAddedBy($user);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $taskDate = $task->getDueDate(); 
            $today = new \DateTime('today');

            if ($taskDate < $today) {
                $this->addFlash('danger', 'La date ne peut pas être antérieure à aujourd\'hui.');
                return $this->redirectToRoute('app_task_new'); 
            }

            $entityManager->persist($task);
            $entityManager->flush();

            $this->addFlash('success', 'La tâche a bien été ajoutée.');

            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $taskDate = $task->getDueDate(); // Replace with the appropriate method for your Task entity
            $today = new \DateTime('today');
    
            if ($taskDate < $today) {
                $this->addFlash('danger', 'La date ne peut pas être antérieure à aujourd\'hui.');
                return $this->redirectToRoute('app_task_edit', ['id' => $task->getId()]); // Redirect with an error message
            }
    
            $entityManager->flush();
    
            $this->addFlash('success', 'La tâche a bien été modifiée');
    
            return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/{id}', name: 'app_task_delete', methods: ['POST'])]
    public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    }
}
