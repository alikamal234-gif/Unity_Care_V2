# 🏥 Unity Care Clinic – Backoffice V2

## 📌 Description du projet

**Unity Care Clinic – Backoffice V2** est une version enrichie du backend web de l’application Unity Care Clinic.  
Cette version étend les fonctionnalités existantes afin de couvrir l’ensemble du parcours patient : **authentification**, **gestion des rendez-vous**, **prescriptions médicales** et **statistiques**, tout en consolidant une architecture **orientée objet (OOP)** en PHP.

Le projet met l’accent sur la **sécurité**, la **gestion des rôles utilisateurs** et la **maintenabilité du code**.

---

## 🎯 Objectifs principaux

- Implémenter un système d’authentification sécurisé avec `$_SESSION`
- Mettre en place un contrôle d’accès basé sur les rôles (RBAC)
- Gérer les rendez-vous médicaux (CRUD)
- Gérer les prescriptions et le catalogue de médicaments
- Sécuriser l’application contre XSS, CSRF et injections SQL
- Enrichir le dashboard avec des statistiques pertinentes
- Consolider l’architecture orientée objet existante
- (Bonus) Ajouter un système de réservation intelligent
- (Bonus) Implémenter un router et des controllers

---

## 👥 Types d’utilisateurs

| Rôle    | Description |
|--------|------------|
| **Admin**   | Gestion globale du système |
| **Doctor**  | Gestion des consultations et prescriptions |
| **Patient** | Prise et suivi des rendez-vous |

---

## 🔐 Authentification & Autorisation

### Hiérarchie des classes


## 🛂 RBAC – Contrôle d’accès par rôle

| Fonctionnalité | Admin | Doctor | Patient |
|----------------|-------|--------|---------|
| Gérer les départements | ✓ | ✗ | ✗ |
| Gérer les médecins | ✓ | ✗ | ✗ |
| Gérer les patients | ✓ | ✓ (lecture seule) | ✗ |
| Gérer les médicaments | ✓ | ✗ | ✗ |
| Voir tous les rendez-vous | ✓ | ✗ | ✗ |
| Voir ses rendez-vous | ✓ | ✓ | ✓ |
| Créer un rendez-vous | ✓ | ✓ | ✓ |
| Annuler un rendez-vous | ✓ | ✓ (les siens) | ✓ (les siens) |
| Créer une prescription | ✗ | ✓ | ✗ |
| Voir ses prescriptions | ✗ | ✓ (créées) | ✓ (reçues) |
| Voir les statistiques | ✓ | ✓ (limitées) | ✗ |

Chaque page vérifie le rôle de l’utilisateur avant affichage.

---

## 📅 Gestion des rendez-vous

### Classe `Appointment`
Un rendez-vous contient :
- Date
- Heure
- Médecin
- Patient
- Motif
- Statut : `scheduled`, `done`, `cancelled`

Fonctionnalités :
- Création de rendez-vous
- Consultation selon le rôle
- Annulation
- Marquage comme effectué (Doctor)

---

## 💊 Prescriptions & Médicaments

### Classes principales
- `Medication`
- `Prescription`

Une prescription lie :
- Un médecin
- Un patient
- Un médicament
- Des instructions de dosage

Fonctionnalités :
- CRUD des médicaments (Admin)
- Création de prescriptions (Doctor)
- Consultation des prescriptions (Patient / Doctor)

---


---

## 📊 Statistiques du dashboard

- Rendez-vous par statut
- Rendez-vous par médecin
- Évolution mensuelle des rendez-vous
- Médicaments les plus prescrits
- Affichage conditionné par rôle

---
